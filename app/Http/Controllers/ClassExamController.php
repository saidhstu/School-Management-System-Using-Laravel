<?php

namespace App\Http\Controllers;

use App\ClassExam;
use App\Sclass;
use Illuminate\Http\Request;

class ClassExamController extends Controller
{
    public function index()
    {
        $records = ClassExam::all();
        return view('admin.ClassExam.index',compact('records'));
    }

    public function store(Request $request)
    {
        $class = Sclass::find($request['class_id']);
        foreach($request['exams'] as $exam) {
            $class->exams()->create(['exam_id' => $exam]);
        }
        return redirect()->back()->with([
            'success' => 'Record Created.'
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'sclass_id' => 'required',
            'exam_id' => 'required'
        ]);

        $record = ClassExam::find($id);
        $record->update($request->all());
        return redirect()->back()->with([
            'success' => 'Record Updated Successfully.'
        ]);
    }

    public function destroy($id)
    {
        $record = ClassExam::find($id);
        $record->delete();
        return redirect()->back()->with([
            'success' => 'Record Deleted Successfully.'
        ]);
    }
}