from django.urls import path

from . import views

# Specifies URL paths within this app
# (relative to the app's base URL, not the site's)
urlpatterns = [

    path('', views.upload, name='upload'),
    path('files/', views.files, name='files'),
    path('verify/', views.verify_credentials, name='verify')
]
