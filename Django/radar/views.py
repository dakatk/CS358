from django.shortcuts import render
from django.http import Http404, HttpResponseForbidden, JsonResponse
from django.views.decorators.csrf import csrf_protect

# Number of images to loop through (constant value)
NUM_IMAGES = 30


# Base url for pulling images
IMAGE_URL = 'http://bergeron.valpo.edu/~wxweb/radar/'


def image_file(radar_type, image_path, index):
    """Returns the absolute url of an image file given type and index"""
    
    global IMAGE_URL
    return IMAGE_URL + image_path + f'/{radar_type}_img{index}.png'


def radar(request):
    """Parses the GET request that loads the radar page"""

    # Dictionary of allowed type ids and
    # their corresponding display names
    radar_types = {'ref': 'Reflectivity',
                   'vel': 'Radial Velocity',
                   'zdr': 'Diff. Reflectivity'}

    # Ensure this is a GET request, otherwise return
    # a 'forbidden' response
    if request.method != 'GET':
        return HttpResponseForbidden()
        
    radar_type = request.GET['type']
    session_key = radar_type + '_get'

    if session_key in request.session:
        context = request.session[session_key]
            
    else:
            
        # Context data to help the page display some
        # data computed from the backend
        context = dict()
            
        if not (radar_type in radar_types):
            raise Http404('Page not found')
            
        else:
            context['radar_name'] = radar_types[radar_type]
            context['radar_type'] = radar_type

            request.session[session_key] = context
    
    # HTML files are found in the site's 'templates' folder
    return render(request, 'radar.html', context)


@csrf_protect
def image_desc(request):
    """Parses the POST request that the page uses to retrieve
    specified data via JS and Ajax"""
    
    global NUM_IMAGES
    
    # Ensure this is a POST request, otherwise return
    # a 'forbidden' response
    if request.method != 'POST':
        return HttpResponseForbidden()

    radar_path_names = {'ref': 'reflectivity',
                        'vel': 'velocity',
                        'zdr': 'diff_refl'}

    radar_type = request.POST['radar_type']

    session_key = radar_type + '_post'

    # Reload from session cookies if applicable
    if session_key in request.session:
        return JsonResponse(request.session[session_key])

    # Check that sent data is a proper value
    if not (radar_type in radar_path_names):
        raise Http404('Files not found')

    image_url = radar_path_names[radar_type]

    # List of every image path used in the loop
    # (setup in the backend helps with this a lot)
    def image_path(i):
        nonlocal image_url
        return image_file(radar_type, image_url, i)

    image_cycle = list(map(image_path, range(NUM_IMAGES)))
    context = {'image_cycle': image_cycle}

    request.session[session_key] = context
    
    return JsonResponse(context)
