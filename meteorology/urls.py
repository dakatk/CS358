"""meteorology URL Configuration

The `urlpatterns` list routes URLs to views. For more information please see:
    https://docs.djangoproject.com/en/2.1/topics/http/urls/
Examples:
Function views
    1. Add an import:  from my_app import views
    2. Add a URL to urlpatterns:  path('', views.home, name='home')
Class-based views
    1. Add an import:  from other_app.views import Home
    2. Add a URL to urlpatterns:  path('', Home.as_view(), name='home')
Including another URLconf
    1. Import the include() function: from django.urls import include, path
    2. Add a URL to urlpatterns:  path('blog/', include('blog.urls'))
"""
from django.urls import include, path, re_path
from django.views.generic.base import RedirectView

favicon_view = RedirectView.as_view(url='/static/favicon.ico', permanent=True)

# Specifies URLs for all apps relative to the site's base URL
urlpatterns = [
    # Home page
    path('', include('home.urls')),
    # Favicon Redirect
    re_path(r'^favicon\.ico$', favicon_view),
    # Valpo Forecast
    path('forecast/', include('forecast.urls')),
    # Valpo Radar
    path('radar/', include('radar.urls')),
    # Regional Satellite
    path('satellite/', include('satellite.urls')),
    # GFS Model
    path('ncep_models/', include('ncep_models.urls')),
    # WRF Model
    path('wrf_model/', include('wrf_model.urls')),
    # KVUM Soundings
    path('soundings/', include('soundings.urls')),
    # Sfc Station Climo
    path('station_climo/', include('station_climo.urls')),
]
