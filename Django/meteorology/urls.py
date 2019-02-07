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
from django.contrib import admin
from django.urls import include, path

# Specifies URLs for all apps relative to the site's base URL
urlpatterns = [
    # Home page
    path('', include('home.urls')),
    # Valpo Forecast
    path('forecast/', include('forecast.urls')),
    # Valpo Radar
    path('radar/', include('radar.urls')),
    # Regional Satellite
    path('satellite/', include('satellite.urls')),
]
