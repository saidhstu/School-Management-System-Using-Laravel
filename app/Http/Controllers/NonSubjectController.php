<?php

namespace App\Http\Controllers;

use App\ClassSubject;
use App\NonSubject;
use App\OptionalSubject;
use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NonSubjectController extends Controller
{
    public function index()
    {
        return view('admin.NonSubject.index');
    }

    public function getSubjects(Request $request)
    {
        $records = Student::where('sclass_id',$request['sclass_id'])
            ->where('session',$request['session'])
            ->where('section_id',$request['section_id'])
            ->where('group_id',$request['group_id'])
            ->get();
        $section_id = $request['section_id'];
        $group_id = $request['group_id'];
        $session = $request['session'];
        $sclass_id = $request['sclass_id'];
        return view('admin.NonSubject.index',compact('records','section_id','sclass_id','group_id','session'));
    }

    public function create()
    {
        return view('admin.NonSubject.add_subject');
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


        return view('admin.NonSubject.subject_insert',compact('students','class_id','section_id','group_id','subject_id','session','subjects'));
    }

    public function store(Request $request)
    {
//        return $request->all();
        foreach($request['students'] as $student) {
            $request['student_id'] = $student;
            $request['student_roll'] = Student::find($student)->roll;
            foreach($request['all_subjects'] as $subject) {
                if(!in_array($subject, $request['student_subjects'][$student])) {
                    NonSubject::create([
                        'sclass_id' => $request['sclass_id'],
                        'section_id' => $request['section_id'],
                        'group_id' => $request['group_id'],
                        'student_id' => $student,
                        'student_roll' => Student::find($student)->roll,
                        'session' => $request['session'],
                        'subject_id' => $subject,
                    ]);
                }
            }

            $request['subject_id'] = $request['optional_subject'][$student];

            OptionalSubject::create($request->all());


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
    public function getOpNon($id)
    {
        $student = Student::find($id);
        $subjects = ClassSubject::select(DB::raw('distinct subject_id'))->where('sclass_id',$student->sclass_id)->where('group_id',$student->group_id)->get();
        return view('admin.NonSubject.set_non',compact('student','subjects'));
    }

    public function setOpNon(Request $request)
    {
        $student = Student::find($request['student_id']);

        $non_subjects = NonSubject::where('sclass_id',$student->sclass_id)
            ->where('student_id',$student->id)
            ->get();

        if(!$non_subjects->isEmpty()) {
            foreach($non_subjects as $non_subject) {
                $get_non = NonSubject::find($non_subject->id);
                if(!empty($get_non)) {
                    $get_non->delete();
                }

            }
        }



        $non_subjects = OptionalSubject::where('sclass_id',$student->sclass_id)
            ->where('student_id',$student->id)
            ->get();


        if(!$non_subjects->isEmpty()) {
            foreach($non_subjects as $non_subject) {
                $get_non = OptionalSubject::find($non_subject->id);
                if(!empty($get_non)) {
                    $get_non->delete();
                }

            }
        }


        foreach($request['student_subjects'] as $subject) {
            NonSubject::create([
                'sclass_id' => $request['sclass_id'],
                'section_id' => $request['section_id'],
                'group_id' => $request['group_id'],
                'student_id' => $student->id,
                'student_roll' => $student->roll,
                'session' => $request['session'],
                'subject_id' => $subject,
            ]);
        }

        OptionalSubject::create([
            'sclass_id' => $request['sclass_id'],
            'section_id' => $request['section_id'],
            'group_id' => $request['group_id'],
            'student_id' => $student->id,
            'student_roll' => $student->roll,
            'session' => $request['session'],
            'subject_id' => $request['optional_subject']
        ]);
        return redirect()->back()->with([
            'success' => 'Subjects Added'
        ]);
    }

    public function getNon()
    {
        return view('admin.NonSubject.set_just_non');
    }

    public function getNonStudents(Request $request)
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


        return view('admin.NonSubject.set_just_non',compact('students','class_id','section_id','group_id','subject_id','session'));
    }

    public function setNon(Request $request)
    {
        foreach($request['students'] as $student) {

            NonSubject::create([
                'sclass_id' => $request['sclass_id'],
                'section_id' => $request['section_id'],
                'group_id' => $request['group_id'],
                'student_id' => $student,
                'student_roll' => Student::find($student)->roll,
                'session' => $request['session'],
                'subject_id' => $request['subject_id']
            ]);

        }

        return redirect('get/non')->with([
            'success' => 'Subjects Added'
        ]);
    }
}

