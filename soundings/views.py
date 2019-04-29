from django.shortcuts import render
from django.http import Http404, HttpResponseForbidden, JsonResponse
from django.views.decorators.csrf import csrf_protect

import os


# Directory which contains the launch data files
LAUNCH_DIR = 'static/soundings/launches'


def soundings(request):
    """Parses the GET request that loads the forecast page"""

    # Stop POST and other potentially harmful requests
    if request.method != 'GET':
        return HttpResponseForbidden()

    # Don't display the page if any thing is passed with the GET request
    if len(request.GET) is not 0:
        raise Http404()

    session_key = 'soundings'

    if session_key in request.session:
        return render(request, 'soundings.html', request.session[session_key])

    context = parse_soundings_data()
    request.session[session_key] = context

    return render(request, 'soundings.html', context)


def parse_soundings_data():
    """Returns parsed context values for soundings"""

    global LAUNCH_DIR

    launch_dirs = get_launch_sub_dirs()
    names = ['' for _ in launch_dirs]

    for (index, ref) in enumerate(launch_dirs):

        std_path = f'{LAUNCH_DIR}/{ref}/{ref}.STD'
        summary_path = f'{LAUNCH_DIR}/{ref}/{ref}_SUMMARY.txt'

        if os.path.isfile(std_path):
            with open(std_path, 'r', encoding='utf-8', errors='ignore') as f:
                names[index] = parse_name_from_std(f)

        elif os.path.isfile(summary_path):
            with open(summary_path, 'r', encoding='utf-8', errors='ignore') as f:
                names[index] = parse_name_from_summary(f)

    return {'names': names}


def parse_name_from_std(std_file):
    """Generates launch name from data in .STD file"""

    first_line = next(std_file)
    line_data = first_line.split(' ')

    date = line_data[5]
    time = line_data[8].replace(':', '')

    return f'{date} at {time}Z'


def parse_name_from_summary(summary_file):
    """Generates launch name from data in _SUMMARY.txt file"""

    line_data = summary_file.read().split(' ')

    date = line_data[235].split('/')
    time = line_data[236].split(':')[:-1]

    for (i, d) in enumerate(date):
        if len(d) < 2:
            date[i] = f'0{d}'

    return '%s at %sZ' % ('/'.join(date), ''.join(time))


@csrf_protect
def images(request):
    """Parses the POST request that the page uses to retrieve
    image data via JS and Ajax"""

    global LAUNCH_DIR

    if request.method != 'POST':
        return HttpResponseForbidden()

    session_key = 'soundings_selects'

    if session_key in request.session:
        return JsonResponse(request.session[session_key])

    image_ref_dirs = get_launch_sub_dirs()

    context = dict()
    # context['image_selects'] = [f'/{LAUNCH_DIR}/{ref}/{ref}_KVUM.png' for ref in image_ref_dirs]
    context['launch_files'] = [f'/{LAUNCH_DIR}/{ref}/{ref}' for ref in image_ref_dirs]
    
    request.session[session_key] = context

    return JsonResponse(context)
    

def get_launch_sub_dirs():
    """Returns all sub-directories of the 'launch' directory as an array"""

    global LAUNCH_DIR

    walk = os.walk(LAUNCH_DIR)
    blacklist = ['launches', '007_001', '039_002', '017_001']

    def dirname(d):
        return d.replace('\\', '/').split('/')[-1]

    dirs = [dirname(d[0]) for d in walk if dirname(d[0]) not in blacklist]

    return sorted(dirs)
