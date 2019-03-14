from django.urls import path
from django.conf import settings
from django.conf.urls.static import static

from . import views

# Specifies URL paths within this app
# (relative to the app's base URL, not the site's)
urlpatterns = [
    
    path('', views.forecast, name='forecast')
    
] + static(settings.STATIC_URL, document_root=settings.STATIC_ROOT)
