from django.urls import path
from . import views

app_name = "crud_app"

urlpatterns=[
    path("crud",  views.index, name="index"),
    path("crud/create", views.create, name="create"),
    path("crud/update/<int:index>", views.update, name="update"),
    path("crud/delete/<int:index>", views.delete, name="delete"),
]