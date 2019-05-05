from django.shortcuts import render
from django.http import Http404, HttpResponseForbidden, JsonResponse
from django.views.decorators.csrf import csrf_protect

import os
import re


# Username and MD5 encoded password bytestring pair for logging into student-specific pages
CREDENTIALS = ['student', b'C\xc3\x8b\xc3\xbc\xc3\x91^\xc3\x8b)\xc2\xb8\xc2\x85\xc3\xa3Z\x15\x13\xc3\x8b1H']

# Possible file endings
ENDINGS = ['.dat', '_STDLVLS.txt', '_SIGLVLS.txt', '_SHARPPY.txt', '_sharppy.png', '_SUMMARY.txt', '_Path.png']

# Session key for login flag
LOGIN_KEY = 'logged_in'

# Session key for flagging rescan of launch directories
RESCAN_KEY = 'rescan_launches'


def upload(request):
    """Parses the GET request that loads the upload page"""

    global LOGIN_KEY

    # Stop POST and other potentially harmful requests
    if request.method != 'GET':
        return HttpResponseForbidden()

    # Don't display the page if any thing is passed with the GET request
    if len(request.GET) is not 0:
        raise Http404()

    if LOGIN_KEY not in request.session:
        return HttpResponseForbidden()

    return render(request, 'upload.html', dict())


@csrf_protect
def verify_credentials(request):
    """Verify that the username and password exist in sent data and
       that they are valid credentials for accessing certain pages"""

    global CREDENTIALS, LOGIN_KEY

    # Only allow POST requests
    if request.method != 'POST':
        return HttpResponseForbidden()

    username = request.POST['modal_username']
    password = bytearray(request.POST['modal_password'], 'UTF-8')

    if [username, password] != CREDENTIALS:
        return JsonResponse({'error': 'Invalid credentials'})

    request.session[LOGIN_KEY] = True

    return JsonResponse({'success': 'Credentials successfully validated'})


@csrf_protect
def files(request):
    """Parses the POST request for uploading files"""

    global RESCAN_KEY

    if request.method != 'POST':
        return HttpResponseForbidden()

    files_dict = dict(request.FILES.lists())

    if 'uploadFile[]' not in files_dict:
        return JsonResponse({'warning': 'Missing file input'})

    written = False

    for file in files_dict['uploadFile[]']:

        launch_timestamp = check_file(file.name)
        
        if launch_timestamp is not None:

            written = True
            write_from_uploaded_file(file, launch_timestamp)

    request.session[RESCAN_KEY] = written

    return JsonResponse({'success': 'Files successfully written'})


def check_file(upload_file_name):
    """Checks and splits the launch timestamp from uploaded files"""

    global ENDINGS

    has_ending = False
    
    for ending in ENDINGS:
        
        if upload_file_name.endswith(ending):
            
            has_ending = True
            break

    if not has_ending:
        return None

    regex = '^[0-9]+_[0-9]+'

    match = re.search(regex, upload_file_name)

    if match is None:
        return None

    return upload_file_name[match.start():match.end()]


def write_from_uploaded_file(uploaded_file, launch_timestamp):
    """Write contents of in-memory uploaded file to
       raw file text on the server"""

    launch_dir = 'static/soundings/launches/' + launch_timestamp

    if not os.path.exists(launch_dir):
        os.mkdir(launch_dir)

    with open(launch_dir + '/' + uploaded_file.name, 'wb') as f:

        for chunk in uploaded_file.chunks():
            f.write(chunk)
