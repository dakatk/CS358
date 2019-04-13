from django.shortcuts import render
from django.http import Http404, HttpResponseForbidden, JsonResponse
from django.views.decorators.csrf import csrf_protect


def upload(request):
    """Parses the GET request that loads the upload page"""

    # Stop POST and other potentially harmful requests
    if request.method != 'GET':
        return HttpResponseForbidden()

    # Don't display the page if any thing is passed with the GET request
    if len(request.GET) is not 0:
        raise Http404()

    return render(request, 'upload.html', dict())


def files(request):
    """Parses the POST request for uploading files"""

    if request.method != 'POST':
        return HttpResponseForbidden()

    print(request.POST)
