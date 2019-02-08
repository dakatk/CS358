from django.shortcuts import render
from django.http import HttpResponseForbidden

def forecast(request):

    # TODO add data to be shown on this page
    context = dict()

    # Stop POST and other potentially harmful requests
    if request.method != 'GET':
        return HttpResponseForbidden()
    
    # HTML files are found in the site's 'templates' folder
    return render(request, 'forecast.html', context)
