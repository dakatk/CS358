from django.shortcuts import render
from django.http import HttpResponseForbidden
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

    # Not sure if this method of getting the text file will stay this way.
    file = open("static/txt/testFile.txt", "r")
    data = file.readlines()
    # Remove White spaces, /n's, and blank lines
    index = len(data) - 1
    while index >= 0:
        data[index] = data[index].strip()
        if data[index] == "":
            data.remove(data[index])
        index -= 1

    # Format variables to be put in context (With dict key "FieldName" + str(i))
    # Spaces are removed from the FieldName
    for i in range(NUM_DAYS):
        for j in range(NUM_FIELDS):
            s = data[i*NUM_FIELDS + j]
            # First "field" of each day will always be the day (I.E. "Today" or "Monday")
            if j == 0:
                context["Day" + str(i)] = s
            else:
                arr = s.split(":")
                context[arr[0].replace(" ", "") + str(i)] = arr[0].strip() + ": " + arr[-1].strip()

    # HTML files are found in the site's 'templates' folder
    return render(request, 'forecast.html', context)
