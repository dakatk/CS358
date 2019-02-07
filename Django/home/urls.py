from django.urls import path

from . import views

# Specifies URL paths within this app
# (relative to the app's base URL, not the site's)
urlpatterns = [
    path('', views.index, name='index'),
]
