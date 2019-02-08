from django.shortcuts import render
from django.http import Http404, HttpResponseForbidden

def radar(request):

    # Dictionary of allowed type ids and
    # their corresponding display names
    radar_types = {'refl': 'Reflectivity',
                   'vel': 'Radial Velocity',
                   'zdr': 'Diff. Reflectivity'}
    context = dict()
    
    if request.method == 'GET':
        radar_type = request.GET['type']
        
        if not (radar_type in radar_types):
            raise Http404('Page not found')
        else:
            context['radar_type'] = radar_types[radar_type]
    else:
        return HttpResponseForbidden()
    
    # HTML files are found in the site's 'templates' folder
    return render(request, 'radar.html', context)
