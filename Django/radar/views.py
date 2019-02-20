from django.shortcuts import render
from django.http import Http404, HttpResponseForbidden, JsonResponse
from django.views.decorators.csrf import csrf_protect

"""
Number of images to loop through (constant value)
"""
NUM_IMAGES = 30

"""
Base url for pulling images
"""
IMAGE_URL = 'http://bergeron.valpo.edu/~wxweb/radar/'


def image_file(radar_type, image_path, index):
    """
    Returns the absolute url of an image file given type and index
    """
    global IMAGE_URL
    return IMAGE_URL + image_path + f"/{radar_type}_img{index}.png"


def radar(request):
    """
    Parses the GET request that loads the radar page
    """
    global NUM_IMAGES

    # Dictionary of allowed type ids and
    # their corresponding display names
    radar_types = {'ref': 'Reflectivity',
                   'vel': 'Radial Velocity',
                   'zdr': 'Diff. Reflectivity'}

    # Context data to help the page display some
    # data computed from the backend
    context = dict()

    # Ensure this is a GET request, otherwise return
    # a 'forbidden' response
    if request.method == 'GET':
        radar_type = request.GET['type']
        
        if not (radar_type in radar_types):
            raise Http404('Page not found')
        else:
            context['radar_name'] = radar_types[radar_type]
            context['radar_type'] = radar_type
    else:
        return HttpResponseForbidden()
    
    # HTML files are found in the site's 'templates' folder
    return render(request, 'radar.html', context)


@csrf_protect
def image_desc(request):
    """
    Parses the POST request that the page uses to retrieve
    specified data via JS and Ajax
    """
    global NUM_IMAGES

    radar_path_names = {'ref': 'reflectivity',
                        'vel': 'velocity',
                        'zdr': 'diff_refl'}
    
    # Ensure this is a POST request, otherwise return
    # a 'forbidden' response
    if request.method != 'POST':
        return HttpResponseForbidden()

    radar_type = request.POST['radar_type']
    if not (radar_type in radar_path_names):
        raise Http404('Files not found')

    image_url = radar_path_names[radar_type]

    # List of every image path used in the loop
    # (setup in the backend helps with this a lot)
    def image_path(i):
        return image_file(radar_type, image_url, i)

    image_cycle = list(map(image_path, range(NUM_IMAGES)))
    context = {'image_cycle': image_cycle}
    
    return JsonResponse(context)
