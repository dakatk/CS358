from django.shortcuts import render
from django.http import Http404, HttpResponseForbidden, JsonResponse
from django.views.decorators.csrf import csrf_protect
from os import listdir
from os.path import isfile, join

# Create your views here.


def station_climo(request):

    if request.method != 'GET':
        return HttpResponseForbidden()

    context = dict()

    context['station_template'] = 'station_climo/' + request.GET['station'] + '.html'
    context['current_station'] = request.GET['station']
    return render(request, 'station_climo.html', context)


@csrf_protect
def file_names(request):

    if request.method != 'POST':
        return HttpResponseForbidden()
    # Post data should contain the current station
    if len(request.POST) < 1:
        return Http404()

    context = dict()

    path = 'templates/station_climo/'
    files = [f for f in listdir(path) if isfile(join(path, f))]
    for index in range(len(files)):
        files[index] = files[index].replace('.html', '')

    path = path + 'files/'
    history_files = [f for f in listdir(path) if isfile(join(path, f))]
    history_file = ''
    # Find the station history file corresponding to the currently selected station
    for item in history_files:
        s = item.split('_')
        if request.POST['current_station'].find(s[0]) != -1:
            history_file = item

    read_file = open(path + history_file, "r")
    output = '<table>'
    for line in read_file.readlines():
        output += '<tr>'
        s = line.split(',')
        for value in s:
            output += '<td>' + value.strip() + '</td>'
        output += '</tr>'
    output += '</table>'
    context['file_names'] = files
    context['history_data'] = output
    return JsonResponse(context)
