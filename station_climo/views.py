from django.shortcuts import render
from django.http import Http404, HttpResponseForbidden, JsonResponse
from django.views.decorators.csrf import csrf_protect
from os import listdir
from os.path import isfile, join

# Create your views here.


def station_climo(request):
    """Parses the GET request that loads the station_climo page"""

    if request.method != 'GET':
        return HttpResponseForbidden()

    context = dict()
    # Set the HTML file of the graph that will be used. This will be included through Django in station_climo.html
    context['station_template'] = 'station_climo/' + request.GET['station'] + '.html'
    s = request.GET['station']
    # current_station is used in the station_climo.js to determine which dropdown is selected when the page loads up
    context['current_station'] = s
    context['current_city'] = s.split('_')[0]
    return render(request, 'station_climo.html', context)


@csrf_protect
def file_names(request):
    """Parses the POST request that the page uses to retrieve
        the list of available files and station history via JS and Ajax"""

    if request.method != 'POST':
        return HttpResponseForbidden()
    # Post data should contain the current station
    if len(request.POST) < 1:
        return Http404()

    context = dict()
    # The path where the files are located
    path = 'templates/station_climo/'
    # A list of strings for all the files in the path directory (Does not include anything in super or sub directories)
    files = [f for f in listdir(path) if isfile(join(path, f))]
    # Remove the .html from the end of the file names
    for index in range(len(files)):
        files[index] = files[index].replace('.html', '')

    # Shift the path a directory further (Where the station history is located)
    path = path + 'files/'
    history_files = [f for f in listdir(path) if isfile(join(path, f))]
    history_file = ''
    # Find the station history file corresponding to the currently selected station.
    # The name of the station starts with the city followed by a '_', which is why it is split and compared this way
    for item in history_files:
        s = item.split('_')
        if request.POST['current_station'].find(s[0]) != -1:
            history_file = item

    read_file = open(path + history_file, "r")
    output = read_file.readlines()
    context['file_names'] = files
    # Data formatting into HTML will be delegated to the end user's device and handled by the javascript
    context['history_data'] = output
    return JsonResponse(context)
