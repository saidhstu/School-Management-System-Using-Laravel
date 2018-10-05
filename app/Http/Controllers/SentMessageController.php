<?php

namespace App\Http\Controllers;

use App\SentMessage;
use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SentMessageController extends Controller
{
    public function index()
    {
        return view('Teacher.SentMessage.index');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'subject' => 'required'
        ]);

        $input = $request->all();
        $student = Student::find($request['student_id']);
        $input['sclass_id'] = $student->sclass_id;
        $input['section_id'] = $student->section_id;
        $input['student_roll'] = $student->roll;
        $input['session'] = $student->session;
        $input['group_id'] = $student->group_id;
        $input['roll'] = $student->roll;
        $input['is_read'] = 1;
        $input['teacher_id'] = Auth::guard('teacher')->user()->id;

//        return $input;
        if($file = $request->file('file')) {
            $image = time(). $file->getClientOriginalName();
            $file->move('website/images',$image);
            $input['file'] = $image;
        }



        SentMessage::create($input);
        return redirect('/sent/message')->with([
            'success' => 'Message sent.'
        ]);
    }

    public function update(Request $request, $id)
    {
        $student = Student::find($id);
        $input = $request->all();
        if($file = $request->file('image')) {
            $image = time(). $file->getClientOriginalName();
            $file->move('images',$image);
            $input['file'] = $image;
        }
        $student->update($input);
        return redirect()->back()->with([
            'success' => 'Student Added Successfully.'
        ]);
    }

    public function destroy($id)
    {
        $record = SentMessage::find($id);
        $record->delete();
        return redirect()->back()->with([
            'success' => 'Record Deleted Successfully.'
        ]);
    }

    public function getStudents(Request $request)
    {
//        return $request->all();
        $records = Student::where('sclass_id',$request['sclass_id'])
            ->where('session',$request['session'])
            ->where('section_id',$request['section_id'])
            ->where('group_id',$request['group_id'])
            ->orderBy('roll','asc')
            ->get();
//        return $students;
        return view('Teacher.SentMessage.index',compact('records'));
    }
}