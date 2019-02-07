from django.shortcuts import render

def forecast(request):

    # TODO add data to be shown on this page
    context = dict()
    # HTML files are found in this app's 'templates' folder
    return render(request, 'forecast.html', context)
