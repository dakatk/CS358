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


@csrf_protect
def files(request):
    """Parses the POST request for uploading files"""

    if request.method != 'POST':
        return HttpResponseForbidden()

    files_dict = dict(request.FILES.lists())

    for file in files_dict['uploadFile[]']:
        write_from_uploaded_file(file)

    return JsonResponse(dict())


def write_from_uploaded_file(uploaded_file):
    """Write contents of in-memory uploaded file to
       raw file text on the server"""

    with open(uploaded_file.name, 'w+') as f:

        for chunk in uploaded_file.chunks():
            f.write(chunk)
