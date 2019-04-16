from django.shortcuts import render
from django.http import Http404, HttpResponseForbidden, JsonResponse
from django.views.decorators.csrf import csrf_protect

# Number of images to loop through (constant value)
NUM_IMAGES = 30

# Base url for pulling images
IMAGE_URL = '/static/satellite/conus/'


def image_file(channel, index):
    """Returns the absolute url of an image file given type and index"""
    
    global IMAGE_URL

    channel_path = f'ch{channel}'
    
    return IMAGE_URL + f'{channel_path}/{channel_path}_img{index}.png'


def satellite(request):
    """Parses the GET request that loads the satellite page"""
    
    # Dictionary of allowed type ids and
    # their corresponding display names
    satellite_channels = {'true_color': 'True-Color',
                          '1_blue': '1: Visible (Blue)',
                          '2_red': '2: Visible (Red)',
                          '4_nir': '4: Cirrus (NIR)',
                          '9_wv': '9: Mid-level WV',
                          '14_longwave': '14: Longwave IR'}

    # Ensure this is a GET request, otherwise return
    # a 'forbidden' response
    if request.method != 'GET':
        return HttpResponseForbidden()
        
    satellite_channel = request.GET['channel']
    session_key = satellite_channel + '_get'

    if session_key in request.session:
        context = request.session[session_key]

    else:
            
        # Context data to help the page display some
        # data computed from the backend
        context = dict()
        
        if satellite_channel not in satellite_channels:
            raise Http404('Page not found')
            
        else:
            context['satellite_channel'] = satellite_channel
            context['satellite_name'] = satellite_channels[satellite_channel]

            request.session[session_key] = context

    # HTML files are found in the site's 'templates' folder
    return render(request, 'satellite.html', context)


@csrf_protect
def images(request):
    """Parses the POST request that the page uses to retrieve
    specified data via JS and Ajax"""
    
    global NUM_IMAGES

    # Ensure this is a POST request, otherwise return
    # a 'forbidden' response
    if request.method != 'POST':
        return HttpResponseForbidden()

    channel_values = {
        'true_color': 2, '1_blue': 1, '2_red': 2,
        '4_nir': 4, '9_wv': 2, '14_longwave': 2
    }

    satellite_channel = request.POST['satellite_channel']

    session_key = satellite_channel + '_post'

    # Reload from session cookies if applicable
    if session_key in request.session:
        return JsonResponse(request.session[session_key])

    # Check that sent data is a proper value
    if satellite_channel not in channel_values:
        raise Http404('Files not found')

    channel_value = channel_values[satellite_channel]

    # List of every image path used in the loop
    # (setup in the backend helps with this a lot)
    def image_path(i):
        nonlocal channel_value
        return image_file(channel_value, i)

    image_cycle = list(map(image_path, range(NUM_IMAGES)))
    context = {'image_cycle': image_cycle}

    request.session[session_key] = context

    return JsonResponse(context)
