from django.urls import path
from django.conf import settings
from django.conf.urls.static import static

from . import views

# Specifies URL paths within this app
# (relative to the app's base URL, not the site's)
urlpatterns = [
    
    path('', views.satellite, name='satellite'),
    path('image_desc/', views.image_desc, name='image_desc')
    
] + static(settings.STATIC_URL, document_root=settings.STATIC_ROOT)
