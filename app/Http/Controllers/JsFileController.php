<?php

namespace App\Http\Controllers;

use App\ClassExam;
use App\ClassGroup;
use App\ClassSection;
use App\ClassSubject;
use Illuminate\Http\Request;

class JsFileController extends Controller
{
    public function getExams(Request $request) {
        $exams = ClassExam::where('sclass_id',$request['sclass_id'])->get();
        return view('js_files.get_exams',compact('exams'));
    }

    public function getSections(Request $request) {
        $sections = ClassSection::where('sclass_id',$request['sclass_id'])->get();
        return view('js_files.get_sections',compact('sections'));
    }

    public function getGroups(Request $request) {
        $groups = ClassGroup::where('sclass_id',$request['sclass_id'])->get();
        return view('js_files.get_groups',compact('groups'));
    }

    public function getSubjects(Request $request) {
        if(!empty($request['group_id'])) {
            $subjects = ClassSubject::where('sclass_id',$request['sclass_id'])
                ->where('exam_id',$request['exam_id'])
                ->where('group_id',$request['group_id'])
                ->orderBy('subject_id')
                ->get();
        } else {
            $subjects = ClassSubject::where('sclass_id',$request['sclass_id'])
                ->where('exam_id',$request['exam_id'])
                ->orderBy('subject_id')
                ->get();
        }

        return view('js_files.get_subjects',compact('subjects'));
    }
}
