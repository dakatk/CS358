from django.shortcuts import render, redirect
from django.http import Http404, HttpResponseForbidden, JsonResponse
from django.views.decorators.csrf import csrf_protect


# Number of images to loop through (constant value)
NUM_IMAGES = 25


# Base url for pulling images
IMAGE_URL = '/static/wrf_model/'


def image_file(model_type, index):
    """Returns the absolute url of an image file given type and index"""

    global IMAGE_URL    
    return IMAGE_URL + '%s_f%03d.png' % (model_type, index * 3) 


def wrf_model(request):
    """Redirects to the MSLP sub-page"""
    
    if request.method != 'GET':
        return HttpResponseForbidden()

    if len(request.GET) is not 0:
        return Http404('Page not found')

    return redirect('/wrf_model/mslp/')


def mslp(request):
    """Parses the GET request that loads the MSLP sub-page"""

    if request.method != 'GET':
        return HttpResponseForbidden()

    if len(request.GET) is not 0:
        return Http404('Page not found')

    context = {
        'model_name': 'MSLP',
        'model_type': 'sfc_mslp_tmpf_wind'
    }
    
    return render(request, 'wrf_model/base.html', context)
    

def temp(request):
    """Parses the GET request that loads the Temp sub-page"""
    
    if request.method != 'GET':
        return HttpResponseForbidden()

    if len(request.GET) is not 1:
        raise Http404('Page not found')

    pressure = request.GET['pressure']

    if pressure not in ('850', '700', '500'):
        raise Http404('Page not found')

    context = {
        'model_name': f'{pressure} hPa Temp',
        'model_type': f'hght_{pressure}_tmpc'
    }

    return render(request, 'wrf_model/temp.html', context)
    

def winds(request):
    """Parses the GET request that loads the Winds sub-page"""
    
    if request.method != 'GET':
        return HttpResponseForbidden()

    if len(request.GET) is not 1:
        raise Http404('Page not found')

    pressure = request.GET['pressure']

    if pressure not in ('850', '700', '500', '300'):
        raise Http404('Page not found')

    context = {
        'model_name': pressure + ' hPa Winds',
        'model_type': 'hght_' + pressure + '_wspd'
    }

    return render(request, 'wrf_model/winds.html', context)
    

def precip(request):
    """Parses the GET request that loads the Precip sub-page"""
    
    if request.method != 'GET':
        return HttpResponseForbidden()

    context = {
        'model_name': 'Precip',
        'model_type': 'sfc_mslp_precip'
    }
        
    if len(request.GET) is 1:
        
        model_type = request.GET['type']

        if model_type not in ('total', '3h_acc'):
            raise Http404('Page not found')

        if model_type != 'total':
            context['model_type'] = 'sfc_mslp_3h_acc_precip'

    elif len(request.GET) is not 0:
        raise Http404('Page not found')

    return render(request, 'wrf_model/precip.html', context)


def abs_vort(request):
    """Parses the GET request that loads the Abs. Vort sub-page"""
    
    if request.method != 'GET':
        return HttpResponseForbidden()

    if len(request.GET) is not 1:
        raise Http404('Page not found')

    pressure = request.GET['pressure']

    if pressure not in ('850', '700', '500', '300'):
        raise Http404('Page not found')

    context = {
        'model_name': pressure + ' hPa Abs Vort',
        'model_type': 'hght_' + pressure + '_avor'
    }

    return render(request, 'wrf_model/abs_vort.html', context)
    

def cape(request):
    """Parses the GET request that loads the CAPE sub-page"""
    
    if request.method != 'GET':
        return HttpResponseForbidden()

    if len(request.GET) is not 0:
        return Http404('Page not found')

    context = {
        'model_name': 'CAPE',
        'model_type': 'sfc_cape_cin'
    }

    return render(request, 'wrf_model/base.html', context)


def sim_dbz(request):
    """Parses the GET request that loads the Sim. dBZ sub-page"""

    if request.method != 'GET':
        return HttpResponseForbidden()

    if len(request.GET) is not 0:
        return Http404('Page not found')

    context = {
        'model_name': 'Sim. dBZ',
        'model_type': 'dbz'
    }

    return render(request, 'wrf_model/base.html', context)
    

@csrf_protect
def images(request):
    """Parses the POST request that the page uses to retrieve
    specified data via JS and Ajax"""

    global NUM_IMAGES

    if request.method != 'POST':
        return HttpResponseForbidden()

    model_type = request.POST['model_type']

    session_key = model_type + '_post'

    if session_key in request.session:
        return JsonResponse(request.session[session_key])

    def image_path(i):
        nonlocal model_type
        return image_file(model_type, i)

    image_cycle = list(map(image_path, range(NUM_IMAGES)))
    context = {'image_cycle': image_cycle[::-1]}

    request.session[session_key] = context

    return JsonResponse(context)
