from django.shortcuts import render
from django.http import Http404, HttpResponseForbidden

def satellite(request):

    # Dictionary of allowed type ids and
    # their corresponding display names
    satellite_types = {'true_color': 'True-Color',
                       '1_blue': '1: Visible (Blue)',
                       '2_red': '2: Visible (Red)',
                       '4_nir': '4: Cirrus (NIR)',
                       '9_wv': '9: Mid-level WV'}
    context = dict()
    
    if request.method == 'GET':
        satellite_type = request.GET['type']
        if not (satellite_type in satellite_types):
            raise Http404('Page not found')
        else:
            context['satellite_type'] = satellite_types[satellite_type]
    else:
        return HttpResponseForbidden()

    # HTML files are found in the site's 'templates' folder
    return render(request, 'satellite.html', context)
