from django.shortcuts import render
from django.http import Http404, HttpResponseForbidden

# Number of images to loop through (constant value)
NUM_IMAGES = 23

# Descriptor of the current radar type, set when the page
# is loaded via a 'GET' request
current_radar_type = None

# Parses the GET request that loads the radar page
def radar(request):
    global NUM_IMAGES, current_radar_type

    # Dictionary of allowed type ids and
    # their corresponding display names
    radar_types = {'refl': 'Reflectivity',
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
            context['radar_type'] = current_radar_type = radar_type
    else:
        return HttpResponseForbidden()
    
    # HTML files are found in the site's 'templates' folder
    return render(request, 'radar.html', context)

# Parses the POST request that the page uses to
# retrieve specified data via JS and Ajax
def image_desc():
    global NUM_IMAGES, current_radar_type

    # Ensure this is a POST request, otherwise return
    # a 'forbidden' response
    if request.method != 'POST':
        return HttpResonseForbidden()
    
    return HttpResponse({'num_images': NUM_IMAGES, 'radar_type': current_radar_type})
    
