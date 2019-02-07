from django.shortcuts import render

def index(request):
    # TODO add data to be shown on this page
    context = {} 
    # HTML files are found in the site's 'templates' folder
    return render(request, 'index.html', context)
