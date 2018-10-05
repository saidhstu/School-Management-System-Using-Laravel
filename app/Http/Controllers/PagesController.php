<?php

namespace App\Http\Controllers;

use App\AbedonForm;
use App\AboutDetails;
use App\AboutMenu;
use App\Bivag;
use App\ClassName;
use App\Co;
use App\LawHead;
use App\Merit;
use App\Prokolpo;


use App\Result;
use App\Secondary;
use App\Teacher;
use App\TrainingHead;
use Codecourse\Notify\Facades\Notify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Session;

class PagesController extends Controller
{
    public function getIndex()
    {
        return view('homepage');
    }

    public function aboutDetails($id)
    {
        $title = AboutMenu::find($id);
        $records = AboutDetails::where('about_menu_id',$id)->get();
        return view('about_details',compact('records','title'));
    }

    public function allTeachers()
    {
        $records = Teacher::all();
        return view('all_teachers',compact('records'));
    }

    public function getBivagTeacher($bivag_id)
    {
        $bivag = Bivag::find($bivag_id);
        $records = Teacher::where('bivag_id',$bivag_id)->get();
        return view('all_teachers',compact('records','bivag'));
    }

    public function getGallery()
    {
        return view('gallery');
    }

    public function getContact()
    {
        return view('contact');
    }

    public function getResult()
    {
        return view('result');
    }

    public function getJob()
    {
        return view('job_korner');
    }

    public function getJobDetails()
    {
        return view('job_details');
    }

    public function searchResult(Request $request)
    {
        $class_id = $request['sclass_id'];
        $exam_id = $request['exam_id'];
        $session = $request['session'];
        $section_id = $request['section_id'];
        $group_id = $request['group_id'];
        if(empty($request['group_id']) && !empty($request['section_id'])){
            $results = Result::where('sclass_id',$request['sclass_id'])
                ->where('exam_id',$request['exam_id'])
                ->where('session',$request['session'])
                ->where('student_roll',$request['student_roll'])
                ->where('section_id',$request['section_id'])
                ->orderBy('subject_id')
                ->get();

            $grade = Merit::where('sclass_id',$request['sclass_id'])
                ->where('exam_id',$request['exam_id'])
                ->where('session',$request['session'])
                ->where('student_roll',$request['student_roll'])
                ->where('section_id',$request['section_id'])
                ->first();

            $merit = Merit::where('sclass_id',$request['sclass_id'])
                ->where('exam_id',$request['exam_id'])
                ->where('session',$request['session'])
                ->where('section_id',$request['section_id'])
                ->orderBy('gpa','desc')
                ->orderBy('total_mark','desc')
                ->orderBy('student_roll','asc')
                ->get();
        } elseif(!empty($request['group_id']) && empty($request['section_id'])) {


            $results = Result::where('sclass_id',$request['sclass_id'])
                ->where('exam_id',$request['exam_id'])
                ->where('session',$request['session'])
                ->where('student_roll',$request['student_roll'])
                ->where('group_id',$request['group_id'])
                ->orderBy('subject_id')
                ->get();

            $grade = Merit::where('sclass_id',$request['sclass_id'])
                ->where('exam_id',$request['exam_id'])
                ->where('session',$request['session'])
                ->where('group_id',$request['group_id'])
                ->where('student_roll',$request['student_roll'])
                ->first();

            $merit = Merit::where('sclass_id',$request['sclass_id'])
                ->where('exam_id',$request['exam_id'])
                ->where('session',$request['session'])
                ->where('group_id',$request['group_id'])
                ->orderBy('gpa','desc')
                ->orderBy('total_mark','desc')
                ->orderBy('student_roll','asc')
                ->get();
        } elseif(!empty($request['group_id']) && !empty($request['section_id'])) {
            $results = Result::where('sclass_id',$request['sclass_id'])
                ->where('exam_id',$request['exam_id'])
                ->where('session',$request['session'])
                ->where('student_roll',$request['student_roll'])
                ->where('section_id',$request['section_id'])
                ->where('group_id',$request['group_id'])
                ->orderBy('subject_id')
                ->get();

            $grade = Merit::where('sclass_id',$request['sclass_id'])
                ->where('exam_id',$request['exam_id'])
                ->where('session',$request['session'])
                ->where('student_roll',$request['student_roll'])
                ->where('section_id',$request['section_id'])
                ->where('group_id',$request['group_id'])
                ->first();

            $merit = Merit::where('sclass_id',$request['sclass_id'])
                ->where('exam_id',$request['exam_id'])
                ->where('session',$request['session'])
                ->where('section_id',$request['section_id'])
                ->where('group_id',$request['group_id'])
                ->orderBy('wo_gpa','desc')
                ->orderBy('total_mark','desc')
                ->orderBy('student_roll','asc')
                ->get();
        } elseif(empty($request['group_id']) && empty($request['section_id'])) {
            $results = Result::where('sclass_id',$request['sclass_id'])
                ->where('exam_id',$request['exam_id'])
                ->where('session',$request['session'])
                ->where('student_roll',$request['student_roll'])
                ->orderBy('rank')
                ->get();

            $grade = Merit::where('sclass_id',$request['sclass_id'])
                ->where('exam_id',$request['exam_id'])
                ->where('session',$request['session'])
                ->where('student_roll',$request['student_roll'])
                ->first();

            $merit = Merit::where('sclass_id',$request['sclass_id'])
                ->where('exam_id',$request['exam_id'])
                ->where('session',$request['session'])
                ->orderBy('gpa','desc')
                ->orderBy('total_mark','desc')
                ->orderBy('student_roll','asc')
                ->get();
        }


        foreach($merit as $key => $m) {
            if($request['student_roll'] == $m->student_roll){
                $merit_pos = $key+1;
            }
        }

//        return $grade;
        return view('result',compact('results','grade','merit_pos','student','class_id','exam_id','session','section_id','group_id'));
    }

    public function co_curri()
    {
        $title = "Co Curriculum";
        $records = Co::all();
        return view('co_curri',compact('records','title'));
    }

    public function error()
    {
        return view('error');
    }
}
