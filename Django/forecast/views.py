from django.shortcuts import render
from django.http import HttpResponseForbidden, Http404
'''
The number of days in the forecast file
'''
NUM_DAYS = 5
'''
The number of fields for each day in the forecast file
'''
NUM_FIELDS = 8


def forecast(request):

    # TODO Implement This System Better
    context = dict()
    # Stop POST and other potentially harmful requests
    if request.method != 'GET':
        return HttpResponseForbidden()
    # Don't display the page if any thing is passed with the GET request
    if len(request.GET) > 0:
        raise Http404()
    # Open and read the file containing the forecast data
    file = open("static/txt/testFile.txt", "r")
    data = file.readlines()
    # Remove white spaces and \n's at front and end of string (#strip) and blank lines
    index = len(data) - 1
    while index >= 0:
        data[index] = data[index].strip()
        if data[index] == "":
            data.remove(data[index])
        index -= 1

    # Store data as a two dimensional list of [day][dataForDay]
    out_data = []
    for i in range(NUM_DAYS):
        arr = []
        for j in range(NUM_FIELDS):
            s = data[i*NUM_FIELDS + j]
            # First "field" of each day will always be the day (I.E. "Today" or "Monday")
            # This if is only necessary because one field has two ':'s
            if j == 0:
                arr.append(s)
            else:
                separated = s.split(":")
                arr.append(separated[0].strip() + ": " + separated[-1].strip())
        out_data.append(arr)

    context["data"] = out_data
    # HTML files are found in the site's 'templates' folder
    return render(request, 'forecast.html', context)
