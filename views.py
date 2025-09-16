from django.shortcuts import render, redirect
from django.http import HttpResponse
from django import forms

# Create your views here.

class StudentForm(forms.Form):
    name = forms.CharField(label="Name", max_length=100)
    age = forms.IntegerField(label="Age")
    course = forms.CharField(label="Course", max_length=100)

def index(request):
    return render(request, "crud_app/list.html", {
        "students" : request.session['students']
    })

def create(request):
    if request.method == "POST":
        form = StudentForm(request.POST)
        if form.is_valid():
            student = form.cleaned_data
            if 'students' not in request.session:
                request.session['students'] = []

            students = request.session['students']
            students.append(student)
            request.session['students'] = students

            return redirect('crud_app:index')

    else:
        form = StudentForm()
        return render(request, "crud_app/create.html", {
            "form" : form
        })

def update(request, index):
    students = request.session.get("students", [])
    student = students[index]
    if request.method == "POST":
        form = StudentForm(request.POST)
        if form.is_valid():
            student[index] = form.cleaned_data
            request.session['students'] = students
            return redirect('crud_app:index')

    else:
        form = StudentForm(initial={
            "name" : student['name'],
            "age" : student['age'],
            "course" : student['course']
        })
        return render(request, "crud_app/edit.html", {
            "form" : form,
            "index" : index
        })

def delete(request, index):
    students = request.session.get('students', [])
    try:
        students.pop(index)
        request.session['students'] = students
    except IndexError:
        pass
    return redirect("crud_app:index")