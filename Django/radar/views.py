from django.shortcuts import render
from django.http import Http404, HttpResponseForbidden

def radar(request):

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
    
    # HTML files are found in this app's 'templates' folder
    return render(request, 'radar.html', context)
