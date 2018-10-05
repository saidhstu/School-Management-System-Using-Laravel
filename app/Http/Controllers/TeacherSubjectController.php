<?php

namespace App\Http\Controllers;

use App\Teacher;
use App\TeacherSubject;
use Illuminate\Http\Request;

class TeacherSubjectController extends Controller
{
    public function index()
    {
        $records = TeacherSubject::all();
        return view('admin.TeacherSubject.index',compact('records'));
    }

    public function store(Request $request)
    {
        $teacher = Teacher::find($request['teacher_id']);
        foreach($request['subjects'] as $subject) {
            $teacher->subjects()->create(['subject_id' => $subject]);
        }
        return redirect()->back()->with([
            'success' => 'Record Created.'
        ]);
    }

    public function update(Request $request, $id)
    {
        $record = TeacherSubject::find($id);
        $record->update($request->all());
        return redirect()->back()->with([
            'success' => 'Record Updated Successfully.'
        ]);
    }

    public function destroy($id)
    {
        $record = TeacherSubject::find($id);
        $record->delete();
        return redirect()->back()->with([
            'success' => 'Record Deleted Successfully.'
        ]);
    }
}