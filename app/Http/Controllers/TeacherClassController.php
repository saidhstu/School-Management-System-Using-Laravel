<?php

namespace App\Http\Controllers;

use App\Teacher;
use App\TeacherClass;
use Illuminate\Http\Request;

class TeacherClassController extends Controller
{
    public function index()
    {
        $records = TeacherClass::all();
        return view('admin.TeacherClass.index',compact('records'));
    }

    public function store(Request $request)
    {
        $teacher = Teacher::find($request['teacher_id']);
        foreach($request['classes'] as $class) {
            $teacher->classes()->create(['sclass_id' => $class]);
        }
        return redirect()->back()->with([
            'success' => 'Record Created.'
        ]);
    }

    public function update(Request $request, $id)
    {
        $record = TeacherClass::find($id);
        $record->update($request->all());
        return redirect()->back()->with([
            'success' => 'Record Updated Successfully.'
        ]);
    }

    public function destroy($id)
    {
        $record = TeacherClass::find($id);
        $record->delete();
        return redirect()->back()->with([
            'success' => 'Record Deleted Successfully.'
        ]);
    }
}