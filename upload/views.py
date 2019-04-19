from django.shortcuts import render
from django.http import Http404, HttpResponseForbidden, JsonResponse
from django.views.decorators.csrf import csrf_protect


# Username and MD5 encoded password bytestring pair for logging into student-specific pages
CREDENTIALS = ['student', b'N\xc3\x972\xc3\xa3\xc2\xbb@\x06\x10\x16\xc3\x9ad:\xc2\x80\x15\xc2\xac\x11']


def upload(request):
    """Parses the GET request that loads the upload page"""

    # Stop POST and other potentially harmful requests
    if request.method != 'GET':
        return HttpResponseForbidden()

    # Don't display the page if any thing is passed with the GET request
    if len(request.GET) is not 0:
        raise Http404()

    if 'logged_in' not in request.session:
        return HttpResponseForbidden()

    return render(request, 'upload.html', dict())


@csrf_protect
def verify_credentials(request):
    """Verify that the username and password exist in sent data and
       that they are valid credentials for accessing certain pages"""

    global CREDENTIALS

    if request.method != 'POST':
        return HttpResponseForbidden()

    if 'modal_username' not in request.POST:
        return JsonResponse({'error': 'Username not supplied'})

    if 'modal_password' not in request.POST:
        return JsonResponse({'error': 'Password not supplied'})

    username = request.POST['modal_username']
    password = bytearray(request.POST['modal_password'], 'UTF-8')

    if [username, password] != CREDENTIALS:
        return JsonResponse({'error': 'Invalid credentials'})

    request.session['logged_in'] = True

    return JsonResponse({'success': 'Credentials successfully validated'})


@csrf_protect
def files(request):
    """Parses the POST request for uploading files"""

    if request.method != 'POST':
        return HttpResponseForbidden()

    files_dict = dict(request.FILES.lists())

    if 'uploadFile[]' not in files_dict:
        return JsonResponse({'info': 'Missing file input'})

    for file in files_dict['uploadFile[]']:
        write_from_uploaded_file(file)

    return JsonResponse({'success': 'Files successfully written'})


def write_from_uploaded_file(uploaded_file):
    """Write contents of in-memory uploaded file to
       raw file text on the server"""

    with open(uploaded_file.name, 'w') as f:

        for chunk in uploaded_file.chunks():
            f.write(chunk)
