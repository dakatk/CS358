from django.shortcuts import render
from django.http import Http404, HttpResponseForbidden

def satellite(request):

    satellite_types = {'true_color': 'True-Color',
                       '1_blue': '1: Visible (Blue)',
                       '2_red': '2: Visible (Red)',
                       '4_nir': '4: Cirrus (NIR)',
                       '9_wv': '9: Mid-level WV'}
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
    return render(request, 'satellite.html', context)
