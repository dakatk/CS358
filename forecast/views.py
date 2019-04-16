from django.shortcuts import render
from django.http import HttpResponseForbidden, Http404


# The number of days in the forecast file
NUM_DAYS = 5


# The number of fields for each day in the forecast file
NUM_FIELDS = 8


def forecast(request):
    """Parses the GET request that loads the forecast page"""
    
    # Stop POST and other potentially harmful requests
    if request.method != 'GET':
        return HttpResponseForbidden()
    
    # Don't display the page if any thing is passed with the GET request
    if len(request.GET) is not 0:
        raise Http404()

    context = parse_forecast_data()

    # HTML files are found in the site's 'templates' folder
    return render(request, 'forecast.html', context)


def parse_forecast_data():

    global NUM_DAYS, NUM_FIELDS
    # Open and read the file containing the forecast data
    file = open("static/forecast/testFile.txt", "r")

    data = []

    for line in file.readlines():

        line = line.strip()

        if line is not '':
            data.append(line)

    days_range = range(NUM_DAYS)
    fields_range = range(NUM_FIELDS)

    # Store data as a two dimensional list of [day][dataForDay]
    out_data = [list(fields_range) for _ in days_range]

    for i in days_range:

        for j in fields_range:

            s = data[i * NUM_FIELDS + j]

            # First "field" of each day will always be the day (I.E. "Today" or "Monday")
            # This if is only necessary because one field has two ':'s
            if j is not 0:
                separated = s.split(":")
                s = separated[0].strip() + ": " + separated[-1].strip()

            out_data[i][j] = s

    return {'data': out_data}
