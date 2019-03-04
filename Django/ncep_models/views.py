from django.shortcuts import render
from django.http import Http404, HttpResponseForbidden, JsonResponse
from django.views.decorators.csrf import csrf_protect

# Number of images to loop through (constant value)
NUM_IMAGES = 81


# Base url for pulling images
IMAGE_URL = 'http://bergeron.valpo.edu/ncep_models/gfs/'


def image_file(index):
    """Returns the absolute url of an image file given the index"""
    
    global IMAGE_URL
    return IMAGE_URL + '/gfs_four_panel_f%d.png' % (index * 3)


def ncep_models(request):
    """Parses the GET request that loads the GFS model page"""
    
    # Ensure this is a GET request, otherwise return
    # a 'forbidden' response
    if request.method != 'GET':
        return HttpResponseForbidden()

    # No additional data should be sent with the request
    if len(request.GET) is not 0:
        raise Http404('Page not found')

    return render(request, 'ncep_models.html', dict())
    

@csrf_protect
def image_desc(request):
    """Parses the POST request that the page uses to retrieve
    specified data via JS and Ajax"""
    
    global NUM_IMAGES
    
    # Ensure this is a POST request, otherwise return
    # a 'forbidden' response
    if request.method != 'POST':
        return HttpResponseForbidden()

    session_key = 'ncep_models'

    # Reload from session cookies if applicable
    if session_key in request.session:
        return JsonResponse(request.session[session_key])

    # No additional data should be sent with the request
    if len(request.POST) is not 0:
        raise Http404('Page not found')

    image_cycle = list(map(image_file, range(NUM_IMAGES)))
    context = {'image_cycle': image_cycle}

    request.session[session_key] = context
    
    return JsonResponse(context)
