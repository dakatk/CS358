from django.urls import path
from django.conf import settings
from django.conf.urls.static import static

from . import views

urlpatterns = [

    path('', views.station_climo, name='station_climo'),
    path('file_names/', views.file_names, name='file_names'),
] + static(settings.STATIC_URL, document_root=settings.STATIC_ROOT)
