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
IMAGE_URL = 'http://bergeron.valpo.edu/~wxweb/satellite/conus/'


def image_file(channel, index):
    """
    Returns the absolute url of an image file given type and index
    """
    global IMAGE_URL

    channel_path = f"ch{channel}"
    return IMAGE_URL + f"{channel_path}/{channel_path}_img{index}.png"


def satellite(request):

    # Dictionary of allowed type ids and
    # their corresponding display names
    satellite_channels = {'true_color': 'True-Color',
                          '1_blue': '1: Visible (Blue)',
                          '2_red': '2: Visible (Red)',
                          '4_nir': '4: Cirrus (NIR)',
                          '9_wv': '9: Mid-level WV',
                          '14_longwave': '14: Longwave IR'}
    context = dict()
    
    if request.method == 'GET':
        satellite_channel = str(request.GET['channel'])
        if not (satellite_channel in satellite_channels):
            raise Http404('Page not found')
        else:
            context['satellite_channel'] = satellite_channel
            context['satellite_name'] = satellite_channels[satellite_channel]
    else:
        return HttpResponseForbidden()

    # HTML files are found in the site's 'templates' folder
    return render(request, 'satellite.html', context)


@csrf_protect
def image_desc(request):
    """
    Parses the POST request that the page uses to retrieve
    specified data via JS and Ajax
    """
    global NUM_IMAGES

    channel_values = {
        'true_color': 2, '1_blue': 1,
        '2_red': 2, '4_nir': 4,
        '9_wv': 2, '14_longwave': 2
    }

    # Ensure this is a POST request, otherwise return
    # a 'forbidden' response
    if request.method != 'POST':
        return HttpResponseForbidden()

    satellite_channel = request.POST['channel']
    if not (satellite_channel in channel_values):
        raise Http404('Files not found')

    channel_value = channel_values[satellite_channel]

    # List of every image path used in the loop
    # (setup in the backend helps with this a lot)
    def image_path(i):
        nonlocal channel_value
        return image_file(channel_value, i)

    image_cycle = list(map(image_path, range(NUM_IMAGES)))
    context = {'image_cycle': image_cycle}

    return JsonResponse(context)
