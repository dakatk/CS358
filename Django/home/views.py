from django.shortcuts import render

def index(request):

    # TODO add data to be shown on this page
    context = dict()

    # Stop POST and other potentially harmful requests
    if request.method != 'GET':
        return HttpResponseForbidden()
    
    # HTML files are found in the site's 'templates' folder
    return render(request, 'index.html', context)
