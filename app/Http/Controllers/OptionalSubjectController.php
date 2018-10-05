<?php

namespace App\Http\Controllers;

use App\ClassSubject;
use App\OptionalSubject;
use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OptionalSubjectController extends Controller
{
    public function index()
    {
        $records = OptionalSubject::all();
        return view('admin.OptionalSubject.index',compact('records'));
    }

    public function create()
    {
        return view('admin.OptionalSubject.add_subject');
    }

    public function getStudents(Request $request)
    {


        $this->validate($request,[
            'sclass_id' => 'required',
            'session' => 'required',
        ]);


        $class_id = $request['sclass_id'];
        $section_id = $request['section_id'];
        $group_id = $request['group_id'];
        $subject_id = $request['subject_id'];
        $session = $request['session'];

        if(empty($request['group_id']) && !empty($request['section_id'])){
            $students = Student::where('sclass_id',$request['sclass_id'])
                ->where('session',$request['session'])
                ->where('section_id',$request['section_id'])
                ->orderBy('roll')
                ->get();
            $subjects = ClassSubject::select(DB::raw('distinct subject_id'))->where('sclass_id',$request['sclass_id'])->get();
        } elseif(!empty($request['group_id']) && empty($request['section_id'])) {
            $students = Student::where('sclass_id',$request['sclass_id'])
                ->where('session',$request['session'])
                ->where('group_id',$request['group_id'])
                ->orderBy('roll')
                ->get();
            $subjects = ClassSubject::select(DB::raw('distinct subject_id'))->where('sclass_id',$request['sclass_id'])->where('group_id',$request['group_id'])->get();
        } elseif(!empty($request['group_id']) && !empty($request['section_id'])) {
            $students = Student::where('sclass_id',$request['sclass_id'])
                ->where('session',$request['session'])
                ->where('section_id',$request['section_id'])
                ->where('group_id',$request['group_id'])
                ->orderBy('roll')
                ->get();
            $subjects = ClassSubject::select(DB::raw('distinct subject_id'))->where('sclass_id',$request['sclass_id'])->where('group_id',$request['group_id'])->get();
        } elseif(empty($request['group_id']) && empty($request['section_id'])) {
            $students = Student::where('sclass_id',$request['sclass_id'])
                ->where('session',$request['session'])
                ->orderBy('roll')
                ->get();
            $subjects = ClassSubject::select(DB::raw('distinct subject_id'))->where('sclass_id',$request['sclass_id'])->get();
        }


        return view('admin.OptionalSubject.subject_insert',compact('students','class_id','section_id','group_id','subject_id','session','subjects'));
    }

    public function store(Request $request)
    {
//        return $request->all();
        foreach($request['students'] as $student) {
            if(!empty($request['subjects'][$student])) {
                $request['student_id'] = $student;
                $request['subject_id'] = $request['subjects'][$student];
                $request['student_roll'] = Student::find($student)->roll;
                OptionalSubject::create($request->all());
            }

        }
    }

    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getOptional()
    {
        return view('admin.NonSubject.set_just_optional');
    }

    public function getOptionalStudents(Request $request)
    {


        $this->validate($request,[
            'sclass_id' => 'required',
            'session' => 'required',
        ]);


        $class_id = $request['sclass_id'];
        $section_id = $request['section_id'];
        $group_id = $request['group_id'];
        $subject_id = $request['subject_id'];
        $session = $request['session'];

        if(empty($request['group_id']) && !empty($request['section_id'])){
            $students = Student::where('sclass_id',$request['sclass_id'])
                ->where('session',$request['session'])
                ->where('section_id',$request['section_id'])
                ->orderBy('roll')
                ->get();
        } elseif(!empty($request['group_id']) && empty($request['section_id'])) {
            $students = Student::where('sclass_id',$request['sclass_id'])
                ->where('session',$request['session'])
                ->where('group_id',$request['group_id'])
                ->orderBy('roll')
                ->get();
        } elseif(!empty($request['group_id']) && !empty($request['section_id'])) {
            $students = Student::where('sclass_id',$request['sclass_id'])
                ->where('session',$request['session'])
                ->where('section_id',$request['section_id'])
                ->where('group_id',$request['group_id'])
                ->orderBy('roll')
                ->get();
        } elseif(empty($request['group_id']) && empty($request['section_id'])) {
            $students = Student::where('sclass_id',$request['sclass_id'])
                ->where('session',$request['session'])
                ->orderBy('roll')
                ->get();
        }


        return view('admin.NonSubject.set_just_optional',compact('students','class_id','section_id','group_id','subject_id','session'));
    }

    public function setOptional(Request $request)
    {
        foreach($request['students'] as $student) {

            OptionalSubject::create([
                'sclass_id' => $request['sclass_id'],
                'section_id' => $request['section_id'],
                'group_id' => $request['group_id'],
                'student_id' => $student,
                'student_roll' => Student::find($student)->roll,
                'session' => $request['session'],
                'subject_id' => $request['subject_id']
            ]);

        }

        return redirect('get/optional')->with([
            'success' => 'Subjects Added'
        ]);
    }
}
