from django.urls import path
from django.conf import settings
from django.conf.urls.static import static

from . import views

# Specifies URL paths within this app
# (relative to the app's base URL, not the site's)
urlpatterns = [

    path('', views.wrf_model, name='wrf_model'),
    path('mslp/', views.mslp, name='mslp'),
    path('tmpc/', views.temp, name='temp'),
    path('wspd/', views.winds, name='winds'),
    path('precip/', views.precip, name='precip'),
    path('avor/', views.abs_vort, name='abs_vort'),
    path('cape/', views.cape, name='cape'),
    path('dbz/', views.sim_dbz, name='sim_dbz'),
    path('images/', views.images, name='images')
    
] + static(settings.STATIC_URL, document_root=settings.STATIC_ROOT)

