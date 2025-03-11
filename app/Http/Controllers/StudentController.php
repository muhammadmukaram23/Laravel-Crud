<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse; // Import this

class StudentController extends Controller
{
    public function index(): View
    {
        $students = Student::all();
        return view('students.index')->with('students', $students);
    }

    public function create(): View
    {
        return view('students.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/students'), $imageName);
            $data['image'] = 'uploads/students/' . $imageName;
        }

        Student::create($data);
        return redirect()->to('/student')->with('success', 'Student added successfully!');


    }

    public function show(string $id): View
    {
        $student = Student::findOrFail($id);
        return view('students.show')->with('students', $student);
    }

    public function edit(string $id): View
    {
        $student = Student::findOrFail($id);
    return view('students.edit')->with('students', $student);
    }

    public function update(Request $request, $id)
    {
        $student = Student::findOrFail($id);
        $data = $request->all();

        if ($request->hasFile('image')) {
            if ($student->image && file_exists(public_path($student->image))) {
                unlink(public_path($student->image));
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/students'), $imageName);
            $data['image'] = 'uploads/students/' . $imageName;
        }

        $student->update($data);
        return redirect()->route('student.index')->with('success', 'Student updated successfully!');
    }

    public function destroy(string $id): RedirectResponse
    {
        $student = Student::findOrFail($id);

        if ($student->image && file_exists(public_path($student->image))) {
            unlink(public_path($student->image));
        }

        $student->delete();
        return redirect()->route('student.index')->with('flash_message', 'Student deleted!');
    }
}
