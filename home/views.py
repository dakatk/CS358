from django.http import Http404, HttpResponseForbidden
from django.shortcuts import render
from forecast.views import parse_forecast_data


def index(request):

    # TODO add data to be shown on this page
    context = dict()

    # Stop POST and other potentially harmful requests
    if request.method != 'GET':
        return HttpResponseForbidden()

    if len(request.GET) > 0:
        return Http404()

    parse_forecast_data(context)

    # HTML files are found in the site's 'templates' folder
    return render(request, 'index.html', context)
