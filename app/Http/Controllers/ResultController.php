<?php

namespace App\Http\Controllers;

use App\ClassSubject;
use App\Exam;
use App\FailSubject;
use App\Merit;
use App\OptionalSubject;
use App\Result;
use App\Sclass;
use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ResultController extends Controller
{
    public function index()
    {
        return view('admin.result');
    }

    public function getConfig()
    {
        return view('admin.config');
    }

    public function addResult()
    {
        $classes = Auth::guard('teacher')->user()->classes;
        $subjects = Auth::guard('teacher')->user()->subjects;
        return view('Teacher.result.add_result',compact('classes','subjects'));
    }

    public function getStudentsMarks(Request $request)
    {

        $this->validate($request,[
            'sclass_id' => 'required',
            'session' => 'required',
        ]);



        $class_id = $request['sclass_id'];
        $section_id = $request['section_id'];
        $group_id = $request['group_id'];
        $exam_id = $request['exam_id'];
        $subject_id = $request['subject_id'];
        $session = $request['session'];

        if(!empty($request['group_id'])) {
            $mark = ClassSubject::where('sclass_id',$request['sclass_id'])
                ->where('exam_id',$request['exam_id'])
                ->where('subject_id',$request['subject_id'])
                ->where('group_id',$request['group_id'])
                ->first();
        } else {
            $mark = ClassSubject::where('sclass_id',$request['sclass_id'])
                ->where('exam_id',$request['exam_id'])
                ->where('subject_id',$request['subject_id'])
                ->first();
        }

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

        return view('Teacher.result.mark_insert',compact('students','mark','class_id','section_id','group_id','exam_id','subject_id','session'));
    }

    public function viewResult()
    {
        return view('admin.result.view_result');
    }

    public function viewAllResult()
    {
        return view('admin.result.view_all_result');
    }


    public function getAllResult(Request $request)
    {
        $class_id = $request['sclass_id'];
        $exam_id = $request['exam_id'];
        $session = $request['session'];
        $section_id = $request['section_id'];
        $group_id = $request['group_id'];
        if(empty($request['group_id']) && !empty($request['section_id'])){
            $students = Result::select(DB::raw('distinct student_id'))
                ->where('sclass_id',$request['sclass_id'])
                ->where('exam_id',$request['exam_id'])
                ->where('session',$request['session'])
                ->where('section_id',$request['section_id'])
                ->get();
        } elseif(!empty($request['group_id']) && empty($request['section_id'])) {
            $students = Result::select(DB::raw('distinct student_id'))
                ->where('sclass_id',$request['sclass_id'])
                ->where('exam_id',$request['exam_id'])
                ->where('session',$request['session'])
                ->where('group_id',$request['group_id'])
                ->get();
        } elseif(!empty($request['group_id']) && !empty($request['section_id'])) {
            $students = Result::select(DB::raw('distinct student_id'))
                ->where('sclass_id',$request['sclass_id'])
                ->where('exam_id',$request['exam_id'])
                ->where('section_id',$request['section_id'])
                ->where('session',$request['session'])
                ->where('group_id',$request['group_id'])
                ->get();
        } elseif(empty($request['group_id']) && empty($request['section_id'])) {
            $students = Result::select(DB::raw('distinct student_id'))
                ->where('sclass_id',$request['sclass_id'])
                ->where('exam_id',$request['exam_id'])
                ->where('session',$request['session'])
                ->get();
        }
        return view('admin.result.get_all_result',compact('students','class_id','exam_id','session','section_id','group_id'));
    }

    public function getResult(Request $request)
    {
        $class_id = $request['sclass_id'];
        $exam_id = $request['exam_id'];
        $session = $request['session'];
        $section_id = $request['section_id'];
        $group_id = $request['group_id'];

        $results = Result::where('sclass_id',$request['sclass_id'])
            ->where('exam_id',$request['exam_id'])
            ->where('session',$request['session'])
            ->where('student_id',$request['student_id'])
            ->where('section_id',$request['section_id'])
            ->where('group_id',$request['group_id'])
            ->orderBy('rank')
            ->get();

        $grade = Merit::where('sclass_id',$request['sclass_id'])
            ->where('exam_id',$request['exam_id'])
            ->where('session',$request['session'])
            ->where('student_id',$request['student_id'])
            ->where('section_id',$request['section_id'])
            ->where('group_id',$request['group_id'])
            ->first();

//        return $grade;
        return view('admin.result.get_result',compact('results','grade','student','class_id','exam_id','session','section_id','group_id'));
    }

    public function viewTabulation()
    {
        return view('admin.result.view_tabulation');
    }

    public function getTabulation(Request $request)
    {
        $class_id = $request['sclass_id'];
        $exam_id = $request['exam_id'];
        $session = $request['session'];
        $section_id = $request['section_id'];
        $group_id = $request['group_id'];
        if(!empty($request['group_id'])) {
            $subjects = ClassSubject::where('sclass_id',$request['sclass_id'])
                ->where('exam_id',$exam_id)
                ->where('group_id',$request['group_id'])
                ->orderBy('subject_id')
                ->get();
        } else {
            $subjects = ClassSubject::where('sclass_id',$request['sclass_id'])
                ->where('exam_id',$exam_id)
                ->orderBy('subject_id')
                ->get();
        }

        if(empty($request['group_id']) && !empty($request['section_id'])){
            $students = Result::select(DB::raw('distinct student_id'))
                ->where('sclass_id',$request['sclass_id'])
                ->where('exam_id',$request['exam_id'])
                ->where('session',$request['session'])
                ->where('section_id',$request['section_id'])
                ->get();
        } elseif(!empty($request['group_id']) && empty($request['section_id'])) {
            $students = Result::select(DB::raw('distinct student_id'))
                ->where('sclass_id',$request['sclass_id'])
                ->where('exam_id',$request['exam_id'])
                ->where('session',$request['session'])
                ->where('group_id',$request['group_id'])
                ->get();
        } elseif(!empty($request['group_id']) && !empty($request['section_id'])) {
            $students = Result::select(DB::raw('distinct student_id'))
                ->where('sclass_id',$request['sclass_id'])
                ->where('session',$request['session'])
                ->where('exam_id',$request['exam_id'])
                ->where('section_id',$request['section_id'])
                ->where('group_id',$request['group_id'])
                ->get();
        } elseif(empty($request['group_id']) && empty($request['section_id'])) {
            $students = Result::select(DB::raw('distinct student_id'))
                ->where('sclass_id',$request['sclass_id'])
                ->where('exam_id',$request['exam_id'])
                ->where('session',$request['session'])
                ->get();
        }

        return view('admin.result.get_tabulation',compact('students','subjects','class_id','session','exam_id','section_id','group_id'));
    }

    public function viewMerit()
    {
        return view('admin.result.view_merit');
    }

    public function getMerit(Request $request)
    {
        $class_id = $request['sclass_id'];
        $exam_id = $request['exam_id'];
        $session = $request['session'];
        $section_id = $request['section_id'];
        $group_id = $request['group_id'];

        $results = Merit::where('sclass_id',$request['sclass_id'])
            ->where('session',$request['session'])
            ->where('exam_id',$request['exam_id'])
            ->where('section_id',$request['section_id'])
            ->where('group_id',$request['group_id'])
            ->where('pass',1)
            ->orderBy('position')
            ->get();

//        return $results;

        return view('admin.result.get_merit',compact('results','class_id','exam_id','session','section_id','group_id'));
    }

    public function viewDemerit()
    {
        return view('admin.result.view_demerit');
    }

    public function getDemerit(Request $request)
    {
        $class_id = $request['sclass_id'];
        $exam_id = $request['exam_id'];
        $session = $request['session'];
        $section_id = $request['section_id'];
        $group_id = $request['group_id'];

        $results = Merit::where('sclass_id',$request['sclass_id'])
            ->where('session',$request['session'])
            ->where('exam_id',$request['exam_id'])
            ->where('section_id',$request['section_id'])
            ->where('group_id',$request['group_id'])
            ->where('fail',1)
            ->orderBy('position')
            ->get();

        return view('admin.result.get_demerit',compact('results','class_id','exam_id','session','section_id','group_id'));
    }


    public function store(Request $request)
    {
        $input['sclass_id'] = $request['sclass_id'];
        $input['section_id'] = $request['section_id'];
        $input['group_id'] = $request['group_id'];
        $input['exam_id'] = $request['exam_id'];
        $input['subject_id'] = $request['subject_id'];
        $input['session'] = $request['session'];
        $exam_id = Exam::find($request['exam_id']);

        if($exam_id->type == "monthly") {
            $mark = ClassSubject::where('sclass_id',$request['sclass_id'])->where('exam_id',$request['exam_id'])->where('subject_id',$request['subject_id'])->first();
            foreach($request['students'] as $student) {
                $stu = Student::find($student);
                $input['section_id'] = $stu->section_id;
                if($request['sub'][$student] <= $mark->subjective && $request['obj'][$student] <= $mark->objective && $request['prac'][$student] <= $mark->practical) {
                    $input['student_id'] = Student::find($student)->roll;
                    if (!empty($request['id'][$student])) {
                        $result = Result::find($request['id'][$student]);
                        $result->delete();
                    }
                    $input['student_id'] = $student;
                    $input['subjective'] = ceil($request['sub'][$student]);
                    $input['objective'] = ceil($request['obj'][$student]);
                    $input['practical'] = ceil($request['prac'][$student]);
                    $input['total'] = $request['sub'][$student] + $request['obj'][$student] + $request['prac'][$student];
                    $input['total_mark'] = $input['total'];
                    $input['percent'] = $input['total'];


                    $input['teacher_id'] = Auth::guard('teacher')->user()->id;
                    Result::create($input);
                }
            }
        } else if($exam_id->type == "normal") {

//            return $request->all();
            $total_points = 0;
            $subject_count = 0;
            $fail = 0;
            $total_mark = 0;
            $total_gpa = 0;
            $total_grade = 0;
            $old_merit = 0;
            $part = "";
            $mark = ClassSubject::where('sclass_id',$request['sclass_id'])->where('group_id',$request['group_id'])->where('exam_id',$request['exam_id'])->where('subject_id',$request['subject_id'])->first();
            //return $mark;
            $input['subjective_limit'] = $mark->subjective;
            $input['objective_limit'] = $mark->objective;
            $input['practical_limit'] = $mark->practical;
            $input['percent_limit'] = $mark->percent;
            $input['rank'] = $mark->rank;
            $input['has_monthly'] = $mark->has_monthly;


            if(!empty($mark->part)) {
                $part_pass = ClassSubject::select(DB::raw('sum(sub_pass) as sub_pass,sum(obj_pass) as obj_pass,sum(percent) as percent,sum(subjective) as sub,sum(objective) as obj,sum(practical) as prac'))->where('sclass_id',$request['sclass_id'])->where('exam_id',$request['exam_id'])->where('group_id',$request['group_id'])->where('part',$mark->part)->first();
            }

            if(!empty($mark->inactive)) {
                $input['inactive'] = 1;
            } else {
                $input['inactive'] = 0;
            }

            foreach($request['students'] as $student) {
                if(!isset($request['non'][$student])) {
                    if($request['sub'][$student] <= $mark->subjective && $request['obj'][$student] <= $mark->objective && $request['prac'][$student] <= $mark->practical) {
                        $input['student_id'] = Student::find($student)->roll;
                        if(!empty($request['id'][$student])) {
                            $result = Result::find($request['id'][$student]);
                            $result->delete();
                        }
                        $optional_check = OptionalSubject::where('student_id',$student)->where('sclass_id',$request['sclass_id'])->where('session',$request['session'])->where('subject_id',$request['subject_id'])->first();
                        $input['student_id'] = $student;
                        $input['subjective'] = ceil($request['sub'][$student]);
                        $input['objective'] = ceil($request['obj'][$student]);
                        $input['practical'] = ceil($request['prac'][$student]);

                        $input['total'] = $request['sub'][$student] + $request['obj'][$student] + $request['prac'][$student];
//                        echo $input['total'];
                        $total_exam_mark = $mark->subjective+$mark->objective+$mark->practical;
                        $input['percent'] = $input['total'] * $mark->percent / $total_exam_mark ;

                        if(!empty($mark->has_monthly)) {
                            $monthly = $request['monthly'][$student];
                            $monthly_limit = $total_exam_mark - $mark->percent;
                            $input['monthly'] = ($monthly * $monthly_limit)/$mark->monthly_limit;
                            $input['monthly'] = $input['monthly'];
                            $input['monthly_limit'] = $monthly_limit;
                            $input['total_mark'] = $input['percent'] + $input['monthly'];
                        } else {
                            $input['total_mark'] = $input['percent'];
                        }

                        echo $input['total_mark']."Total Mark<br>";

                        $input['is_sub_pass'] = $input['subjective'] < $mark->sub_pass ? 1 : 0;
                        $input['is_obj_pass'] = $input['objective'] < $mark->obj_pass ? 1 : 0;
                        $input['is_prac_pass'] = $input['practical'] < $mark->prac_pass ? 1 : 0;

                        if(!empty($mark->part)) {

                            $mark_limit = $part_pass->sub + $part_pass->obj + $part_pass->prac;
                            $part_mark = Result::where("student_id",$student)
                                ->where('sclass_id',$request['sclass_id'])
                                ->where('exam_id',$request['exam_id'])
                                ->where('session',$request['session'])
                                ->where('part',$mark->part)
                                ->first();

                            if(!empty($request['monthly'][$student])) {
                                $input['part_monthly'] = $input['monthly'];
                            }

                            $input['part_sub'] = $input['subjective'];
                            $input['part_obj'] = $input['objective'];
                            $input['part_prac'] = $input['practical'];
                            $input['part_mark'] = $input['total_mark'];
                            $input['part'] = $mark->part;
                            $input['part_details'] = $mark->part_details;

                            if(!empty($part_mark)) {
                                $old_part = Result::find($part_mark->id);
                                if(!empty($request['monthly'][$student])) {
                                    $input['part_monthly'] += $part_mark->monthly;
                                }
                                $input['part_sub'] += $part_mark->subjective;
                                $input['part_obj'] += $part_mark->objective;
                                $input['part_prac'] += $part_mark->practical;
                                $input['part_mark'] += $part_mark->total_mark;
                            }

                            if(empty($mark->total_pass) && empty($mark->single_pass)) {
                                if($input['part_sub'] < $part_pass->sub_pass || $input['part_obj'] < $part_pass->obj_pass) {
                                    if(!empty($old_part)) {
                                        if(!empty($request['monthly'][$student])) {
                                            $old_part->update(['part_monthly' => $input['part_monthly'],'part_sub' => $input['part_sub'], "part_obj" => $input['part_obj'], "part_prac" => $input['part_prac'], "part_mark" => $input['part_mark'], 'grade' => 'F', 'gpa' => '0.00']);
                                        } else {
                                            $old_part->update(['part_sub' => $input['part_sub'], "part_obj" => $input['part_obj'], "part_prac" => $input['part_prac'], "part_mark" => $input['part_mark'], 'grade' => 'F', 'gpa' => '0.00']);
                                        }
                                    }
                                    $input['grade'] = "F";
                                    $input['gpa'] = 0;
                                    if(empty($request['group_id']) && !empty($request['section_id'])){
                                        $fail_subject = FailSubject::where('sclass_id',$request['sclass_id'])
                                            ->where('exam_id',$request['exam_id'])
                                            ->where('session',$request['session'])
                                            ->where('student_id',$input['student_id'])
                                            ->where('section_id',$request['section_id'])
                                            ->where('part',$input['part'])
                                            ->first();
                                        if(empty($fail_subject)) {
                                            if(empty($optional_check) && empty($input['inactive'])) {
                                                FailSubject::create($input);
                                            }
                                        }

                                    } elseif(!empty($request['group_id']) && empty($request['section_id'])) {
                                        $fail_subject = FailSubject::where('sclass_id',$request['sclass_id'])
                                            ->where('exam_id',$request['exam_id'])
                                            ->where('session',$request['session'])
                                            ->where('student_id',$input['student_id'])
                                            ->where('group_id',$request['group_id'])
                                            ->where('part',$input['part'])
                                            ->first();
                                        if(empty($fail_subject)) {
                                            if(empty($optional_check) && empty($input['inactive'])) {
                                                FailSubject::create($input);
                                            }
                                        }

                                    } elseif(!empty($request['group_id']) && !empty($request['section_id'])) {
                                        $fail_subject = FailSubject::where('sclass_id',$request['sclass_id'])
                                            ->where('session',$request['session'])
                                            ->where('exam_id',$request['exam_id'])
                                            ->where('student_id',$input['student_id'])
                                            ->where('section_id',$request['section_id'])
                                            ->where('group_id',$request['group_id'])
                                            ->where('part',$input['part'])
                                            ->first();
                                        if(empty($fail_subject)) {
                                            if(empty($optional_check) && empty($input['inactive'])) {
                                                FailSubject::create($input);
                                            }
                                        }

                                    } elseif(empty($request['group_id']) && empty($request['section_id'])) {
                                        $fail_subject = FailSubject::where('sclass_id',$request['sclass_id'])
                                            ->where('exam_id',$request['exam_id'])
                                            ->where('session',$request['session'])
                                            ->where('student_id',$input['student_id'])
                                            ->where('part',$input['part'])
                                            ->first();

                                        if(empty($fail_subject)) {
                                            if(empty($optional_check) && empty($input['inactive'])) {
                                                FailSubject::create($input);
                                            }
                                        }
                                    }

                                } else {
                                    echo $input['part_mark']."-".$mark_limit."<br>";
                                    $grade_info = grade($input['part_mark'],$mark_limit);
                                    $gpa_info = explode("_",$grade_info);
                                    $input['grade'] = $gpa_info[0];
                                    $input['gpa'] = $gpa_info[1];

                                    if(empty($request['group_id']) && !empty($request['section_id'])){
                                        $fail_subject = FailSubject::where('sclass_id',$request['sclass_id'])
                                            ->where('exam_id',$request['exam_id'])
                                            ->where('session',$request['session'])
                                            ->where('student_id',$input['student_id'])
                                            ->where('section_id',$request['section_id'])
                                            ->where('part',$input['part'])
                                            ->first();
                                        if(!empty($fail_subject)) {
                                            $fail_del = FailSubject::find($fail_subject->id);
                                            $fail_del->delete();
                                        }

                                    } elseif(!empty($request['group_id']) && empty($request['section_id'])) {
                                        $fail_subject = FailSubject::where('sclass_id',$request['sclass_id'])
                                            ->where('exam_id',$request['exam_id'])
                                            ->where('session',$request['session'])
                                            ->where('student_id',$input['student_id'])
                                            ->where('group_id',$request['group_id'])
                                            ->where('part',$input['part'])
                                            ->first();
                                        if(!empty($fail_subject)) {
                                            $fail_del = FailSubject::find($fail_subject->id);
                                            $fail_del->delete();
                                        }

                                    } elseif(!empty($request['group_id']) && !empty($request['section_id'])) {
                                        $fail_subject = FailSubject::where('sclass_id',$request['sclass_id'])
                                            ->where('session',$request['session'])
                                            ->where('exam_id',$request['exam_id'])
                                            ->where('student_id',$input['student_id'])
                                            ->where('section_id',$request['section_id'])
                                            ->where('group_id',$request['group_id'])
                                            ->where('part',$input['part'])
                                            ->first();
                                        if(!empty($fail_subject)) {
                                            $fail_del = FailSubject::find($fail_subject->id);
                                            $fail_del->delete();
                                        }

                                    } elseif(empty($request['group_id']) && empty($request['section_id'])) {
                                        $fail_subject = FailSubject::where('sclass_id',$request['sclass_id'])
                                            ->where('exam_id',$request['exam_id'])
                                            ->where('session',$request['session'])
                                            ->where('student_id',$input['student_id'])
                                            ->where('part',$input['part'])
                                            ->first();

                                        if(!empty($fail_subject)) {
                                            $fail_del = FailSubject::find($fail_subject->id);
                                            $fail_del->delete();
                                        }
                                    }

                                    if(!empty($old_part)) {
                                        if(!empty($request['monthly'][$student])) {
                                            $old_part->update(['part_monthly' => $input['part_monthly'],'part_sub' => $input['part_sub'], "part_obj" => $input['part_obj'], "part_prac" => $input['part_prac'], "part_mark" => $input['part_mark'], 'grade' => $input['grade'], 'gpa' => $input['gpa']]);
                                        } else {
                                            $old_part->update(['part_sub' => $input['part_sub'], "part_obj" => $input['part_obj'], "part_prac" => $input['part_prac'], "part_mark" => $input['part_mark'], 'grade' => $input['grade'], 'gpa' => $input['gpa']]);
                                        }
                                    }
                                }
                            } else if($mark->single_pass == 1 && $mark->total_pass != 1) {

                                if(!empty($input['is_sub_pass']) || !empty($input['is_obj_pass']) || !empty($input['is_prac_pass'])) {

                                    if(!empty($old_part)) {
                                        if(!empty($request['monthly'][$student])) {
                                            $old_part->update(['part_monthly' => $input['part_monthly'],'part_sub' => $input['part_sub'], "part_obj" => $input['part_obj'], "part_prac" => $input['part_prac'], "part_mark" => $input['part_mark'], 'grade' => 'F', 'gpa' => '0.00']);
                                        } else {
                                            $old_part->update(['part_sub' => $input['part_sub'], "part_obj" => $input['part_obj'], "part_prac" => $input['part_prac'], "part_mark" => $input['part_mark'], 'grade' => 'F', 'gpa' => '0.00']);
                                        }
                                    }
                                    $input['grade'] = "F";
                                    $input['gpa'] = 0;
                                    if(empty($request['group_id']) && !empty($request['section_id'])){
                                        $fail_subject = FailSubject::where('sclass_id',$request['sclass_id'])
                                            ->where('exam_id',$request['exam_id'])
                                            ->where('session',$request['session'])
                                            ->where('student_id',$input['student_id'])
                                            ->where('section_id',$request['section_id'])
                                            ->where('part',$input['part'])
                                            ->first();
                                        if(empty($fail_subject)) {
                                            if(empty($optional_check) && empty($input['inactive'])) {
                                                FailSubject::create($input);
                                            }
                                        }

                                    } elseif(!empty($request['group_id']) && empty($request['section_id'])) {
                                        $fail_subject = FailSubject::where('sclass_id',$request['sclass_id'])
                                            ->where('exam_id',$request['exam_id'])
                                            ->where('session',$request['session'])
                                            ->where('student_id',$input['student_id'])
                                            ->where('group_id',$request['group_id'])
                                            ->where('part',$input['part'])
                                            ->first();
                                        if(empty($fail_subject)) {
                                            if(empty($optional_check) && empty($input['inactive'])) {
                                                FailSubject::create($input);
                                            }
                                        }

                                    } elseif(!empty($request['group_id']) && !empty($request['section_id'])) {
                                        $fail_subject = FailSubject::where('sclass_id',$request['sclass_id'])
                                            ->where('session',$request['session'])
                                            ->where('exam_id',$request['exam_id'])
                                            ->where('student_id',$input['student_id'])
                                            ->where('section_id',$request['section_id'])
                                            ->where('group_id',$request['group_id'])
                                            ->where('part',$input['part'])
                                            ->first();
                                        if(empty($fail_subject)) {
                                            if(empty($optional_check) && empty($input['inactive'])) {
                                                FailSubject::create($input);
                                            }
                                        }

                                    } elseif(empty($request['group_id']) && empty($request['section_id'])) {
                                        $fail_subject = FailSubject::where('sclass_id',$request['sclass_id'])
                                            ->where('exam_id',$request['exam_id'])
                                            ->where('session',$request['session'])
                                            ->where('student_id',$input['student_id'])
                                            ->where('part',$input['part'])
                                            ->first();

                                        if(empty($fail_subject)) {
                                            if(empty($optional_check) && empty($input['inactive'])) {
                                                FailSubject::create($input);
                                            }
                                        }
                                    }

                                } else {
                                    echo $input['part_mark']."-".$mark_limit."<br>";
                                    $grade_info = grade($input['part_mark'],$mark_limit);
                                    $gpa_info = explode("_",$grade_info);
                                    $input['grade'] = $gpa_info[0];
                                    $input['gpa'] = $gpa_info[1];

                                    if(empty($request['group_id']) && !empty($request['section_id'])){
                                        $fail_subject = FailSubject::where('sclass_id',$request['sclass_id'])
                                            ->where('exam_id',$request['exam_id'])
                                            ->where('session',$request['session'])
                                            ->where('student_id',$input['student_id'])
                                            ->where('section_id',$request['section_id'])
                                            ->where('part',$input['part'])
                                            ->first();
                                        if(!empty($fail_subject)) {
                                            $fail_del = FailSubject::find($fail_subject->id);
                                            $fail_del->delete();
                                        }

                                    } elseif(!empty($request['group_id']) && empty($request['section_id'])) {
                                        $fail_subject = FailSubject::where('sclass_id',$request['sclass_id'])
                                            ->where('exam_id',$request['exam_id'])
                                            ->where('session',$request['session'])
                                            ->where('student_id',$input['student_id'])
                                            ->where('group_id',$request['group_id'])
                                            ->where('part',$input['part'])
                                            ->first();
                                        if(!empty($fail_subject)) {
                                            $fail_del = FailSubject::find($fail_subject->id);
                                            $fail_del->delete();
                                        }

                                    } elseif(!empty($request['group_id']) && !empty($request['section_id'])) {
                                        $fail_subject = FailSubject::where('sclass_id',$request['sclass_id'])
                                            ->where('session',$request['session'])
                                            ->where('exam_id',$request['exam_id'])
                                            ->where('student_id',$input['student_id'])
                                            ->where('section_id',$request['section_id'])
                                            ->where('group_id',$request['group_id'])
                                            ->where('part',$input['part'])
                                            ->first();
                                        if(!empty($fail_subject)) {
                                            $fail_del = FailSubject::find($fail_subject->id);
                                            $fail_del->delete();
                                        }

                                    } elseif(empty($request['group_id']) && empty($request['section_id'])) {
                                        $fail_subject = FailSubject::where('sclass_id',$request['sclass_id'])
                                            ->where('exam_id',$request['exam_id'])
                                            ->where('session',$request['session'])
                                            ->where('student_id',$input['student_id'])
                                            ->where('part',$input['part'])
                                            ->first();

                                        if(!empty($fail_subject)) {
                                            $fail_del = FailSubject::find($fail_subject->id);
                                            $fail_del->delete();
                                        }
                                    }




                                    if(!empty($old_part)) {
                                        if(!empty($request['monthly'][$student])) {
                                            $old_part->update(['part_monthly' => $input['part_monthly'],'part_sub' => $input['part_sub'], "part_obj" => $input['part_obj'], "part_prac" => $input['part_prac'], "part_mark" => $input['part_mark'], 'grade' => $input['grade'], 'gpa' => $input['gpa']]);
                                        } else {
                                            $old_part->update(['part_sub' => $input['part_sub'], "part_obj" => $input['part_obj'], "part_prac" => $input['part_prac'], "part_mark" => $input['part_mark'], 'grade' => $input['grade'], 'gpa' => $input['gpa']]);
                                        }
                                    }
                                }
                            } else {

                                $total_pass = $part_pass->sub_pass + $part_pass->obj_pass;
                                echo $total_pass."-".$input['part_mark']."<br>";
                                if($input['part_mark'] < $total_pass) {
                                    if(!empty($old_part)) {
                                        if(!empty($request['monthly'][$student])) {
                                            $old_part->update(['part_monthly' => $input['part_monthly'],'part_sub' => $input['part_sub'], "part_obj" => $input['part_obj'], "part_prac" => $input['part_prac'], "part_mark" => $input['part_mark'], 'grade' => 'F', 'gpa' => '0.00']);
                                        } else {
                                            $old_part->update(['part_sub' => $input['part_sub'], "part_obj" => $input['part_obj'], "part_prac" => $input['part_prac'], "part_mark" => $input['part_mark'], 'grade' => 'F', 'gpa' => '0.00']);
                                        }
                                    }
                                    $input['grade'] = "F";
                                    $input['gpa'] = 0;
                                    if(empty($request['group_id']) && !empty($request['section_id'])){
                                        $fail_subject = FailSubject::where('sclass_id',$request['sclass_id'])
                                            ->where('exam_id',$request['exam_id'])
                                            ->where('session',$request['session'])
                                            ->where('student_id',$input['student_id'])
                                            ->where('section_id',$request['section_id'])
                                            ->where('part',$input['part'])
                                            ->first();
                                        if(empty($fail_subject)) {
                                            if(empty($optional_check) && empty($input['inactive'])) {
                                                FailSubject::create($input);
                                            }
                                        }

                                    } elseif(!empty($request['group_id']) && empty($request['section_id'])) {
                                        $fail_subject = FailSubject::where('sclass_id',$request['sclass_id'])
                                            ->where('exam_id',$request['exam_id'])
                                            ->where('session',$request['session'])
                                            ->where('student_id',$input['student_id'])
                                            ->where('group_id',$request['group_id'])
                                            ->where('part',$input['part'])
                                            ->first();
                                        if(empty($fail_subject)) {
                                            if(empty($optional_check) && empty($input['inactive'])) {
                                                FailSubject::create($input);
                                            }
                                        }

                                    } elseif(!empty($request['group_id']) && !empty($request['section_id'])) {
                                        $fail_subject = FailSubject::where('sclass_id',$request['sclass_id'])
                                            ->where('session',$request['session'])
                                            ->where('exam_id',$request['exam_id'])
                                            ->where('student_id',$input['student_id'])
                                            ->where('section_id',$request['section_id'])
                                            ->where('group_id',$request['group_id'])
                                            ->where('part',$input['part'])
                                            ->first();
                                        if(empty($fail_subject)) {
                                            if(empty($optional_check) && empty($input['inactive'])) {
                                                FailSubject::create($input);
                                            }
                                        }

                                    } elseif(empty($request['group_id']) && empty($request['section_id'])) {
                                        $fail_subject = FailSubject::where('sclass_id',$request['sclass_id'])
                                            ->where('exam_id',$request['exam_id'])
                                            ->where('session',$request['session'])
                                            ->where('student_id',$input['student_id'])
                                            ->where('part',$input['part'])
                                            ->first();



                                        if(empty($fail_subject)) {
                                            if(empty($optional_check) && empty($input['inactive'])) {
                                                FailSubject::create($input);
                                            }
                                        }
                                    }

                                } else {
                                    echo $input['part_mark']."-".$mark_limit."<br>";
                                    $grade_info = grade($input['part_mark'],$mark_limit);
                                    $gpa_info = explode("_",$grade_info);
                                    $input['grade'] = $gpa_info[0];
                                    $input['gpa'] = $gpa_info[1];

                                    if(empty($request['group_id']) && !empty($request['section_id'])){
                                        $fail_subject = FailSubject::where('sclass_id',$request['sclass_id'])
                                            ->where('exam_id',$request['exam_id'])
                                            ->where('session',$request['session'])
                                            ->where('student_id',$input['student_id'])
                                            ->where('section_id',$request['section_id'])
                                            ->where('part',$input['part'])
                                            ->first();
                                        if(!empty($fail_subject)) {
                                            $fail_del = FailSubject::find($fail_subject->id);
                                            $fail_del->delete();
                                        }


                                    } elseif(!empty($request['group_id']) && empty($request['section_id'])) {
                                        $fail_subject = FailSubject::where('sclass_id',$request['sclass_id'])
                                            ->where('exam_id',$request['exam_id'])
                                            ->where('session',$request['session'])
                                            ->where('student_id',$input['student_id'])
                                            ->where('group_id',$request['group_id'])
                                            ->where('part',$input['part'])
                                            ->first();
                                        if(!empty($fail_subject)) {
                                            $fail_del = FailSubject::find($fail_subject->id);
                                            $fail_del->delete();
                                        }

                                    } elseif(!empty($request['group_id']) && !empty($request['section_id'])) {

                                        $fail_subject = FailSubject::where('sclass_id',$request['sclass_id'])
                                            ->where('session',$request['session'])
                                            ->where('exam_id',$request['exam_id'])
                                            ->where('student_id',$input['student_id'])
                                            ->where('section_id',$request['section_id'])
                                            ->where('group_id',$request['group_id'])
                                            ->where('part',$input['part'])
                                            ->first();
                                        if(!empty($fail_subject)) {
                                            $fail_del = FailSubject::find($fail_subject->id);
                                            $fail_del->delete();
                                        }

                                    } elseif(empty($request['group_id']) && empty($request['section_id'])) {
                                        $fail_subject = FailSubject::where('sclass_id',$request['sclass_id'])
                                            ->where('exam_id',$request['exam_id'])
                                            ->where('session',$request['session'])
                                            ->where('student_id',$input['student_id'])
                                            ->where('part',$input['part'])
                                            ->first();



                                        if(!empty($fail_subject)) {
                                            $fail_del = FailSubject::find($fail_subject->id);
                                            $fail_del->delete();
                                        }
                                    }




                                    if(!empty($old_part)) {
                                        if(!empty($request['monthly'][$student])) {
                                            $old_part->update(['part_monthly' => $input['part_monthly'],'part_sub' => $input['part_sub'], "part_obj" => $input['part_obj'], "part_prac" => $input['part_prac'], "part_mark" => $input['part_mark'], 'grade' => $input['grade'], 'gpa' => $input['gpa']]);
                                        } else {
                                            $old_part->update(['part_sub' => $input['part_sub'], "part_obj" => $input['part_obj'], "part_prac" => $input['part_prac'], "part_mark" => $input['part_mark'], 'grade' => $input['grade'], 'gpa' => $input['gpa']]);
                                        }
                                    }
                                }
                            }


                        } else { // End of part calculation
                            $mark_limit = $mark->subjective + $mark->objective + $mark->practical;
//                            echo $mark_limit."-".$input['total_mark']."<br>";
                            if($mark->single_pass == 1) {
                                if(!empty($input['is_sub_pass']) || !empty($input['is_obj_pass']) || !empty($input['is_prac_pass'])) {
                                    $input['grade'] = "F";
                                    $input['gpa'] = 0;

                                    if(empty($request['group_id']) && !empty($request['section_id'])){
                                        $fail_subject = FailSubject::where('sclass_id',$request['sclass_id'])
                                            ->where('exam_id',$request['exam_id'])
                                            ->where('session',$request['session'])
                                            ->where('student_id',$input['student_id'])
                                            ->where('section_id',$request['section_id'])
                                            ->where('subject_id',$request['subject_id'])
                                            ->first();
                                        if(empty($fail_subject)) {
                                            if(empty($optional_check) && empty($input['inactive'])) {
                                                FailSubject::create($input);
                                            }
                                        }

                                    } elseif(!empty($request['group_id']) && empty($request['section_id'])) {
                                        $fail_subject = FailSubject::where('sclass_id',$request['sclass_id'])
                                            ->where('exam_id',$request['exam_id'])
                                            ->where('session',$request['session'])
                                            ->where('student_id',$input['student_id'])
                                            ->where('group_id',$request['group_id'])
                                            ->where('subject_id',$request['subject_id'])
                                            ->first();
                                        if(empty($fail_subject)) {
                                            if(empty($optional_check) && empty($input['inactive'])) {
                                                FailSubject::create($input);
                                            }
                                        }

                                    } elseif(!empty($request['group_id']) && !empty($request['section_id'])) {
                                        $fail_subject = FailSubject::where('sclass_id',$request['sclass_id'])
                                            ->where('session',$request['session'])
                                            ->where('exam_id',$request['exam_id'])
                                            ->where('student_id',$input['student_id'])
                                            ->where('section_id',$request['section_id'])
                                            ->where('group_id',$request['group_id'])
                                            ->where('subject_id',$request['subject_id'])
                                            ->first();
                                        if(empty($fail_subject)) {
                                            if(empty($optional_check) && empty($input['inactive'])) {
                                                FailSubject::create($input);
                                            }
                                        }

                                    } elseif(empty($request['group_id']) && empty($request['section_id'])) {
                                        $fail_subject = FailSubject::where('sclass_id',$request['sclass_id'])
                                            ->where('exam_id',$request['exam_id'])
                                            ->where('session',$request['session'])
                                            ->where('subject_id',$request['subject_id'])
                                            ->where('student_id',$input['student_id'])
                                            ->first();

                                        if(empty($fail_subject)) {
                                            if(empty($optional_check) && empty($input['inactive'])) {
                                                FailSubject::create($input);
                                            }
                                        }
                                    }
                                } else {
                                    echo $input['total_mark']."-".$mark_limit."<br>";
                                    $grade_info = grade($input['total_mark'],$mark_limit);
                                    $gpa_info = explode("_",$grade_info);
                                    $input['grade'] = $gpa_info[0];
                                    $input['gpa'] = $gpa_info[1];

                                    if($input['grade'] == "F") {
                                        if(empty($request['group_id']) && !empty($request['section_id'])){
                                            $fail_subject = FailSubject::where('sclass_id',$request['sclass_id'])
                                                ->where('exam_id',$request['exam_id'])
                                                ->where('session',$request['session'])
                                                ->where('student_id',$input['student_id'])
                                                ->where('section_id',$request['section_id'])
                                                ->where('subject_id',$request['subject_id'])
                                                ->first();
                                            if(empty($fail_subject)) {
                                                if(empty($optional_check) && empty($input['inactive'])) {
                                                    FailSubject::create($input);
                                                }
                                            }

                                        } elseif(!empty($request['group_id']) && empty($request['section_id'])) {
                                            $fail_subject = FailSubject::where('sclass_id',$request['sclass_id'])
                                                ->where('exam_id',$request['exam_id'])
                                                ->where('session',$request['session'])
                                                ->where('student_id',$input['student_id'])
                                                ->where('group_id',$request['group_id'])
                                                ->where('subject_id',$request['subject_id'])
                                                ->first();
                                            if(empty($fail_subject)) {
                                                if(empty($optional_check) && empty($input['inactive'])) {
                                                    FailSubject::create($input);
                                                }
                                            }

                                        } elseif(!empty($request['group_id']) && !empty($request['section_id'])) {
                                            $fail_subject = FailSubject::where('sclass_id',$request['sclass_id'])
                                                ->where('session',$request['session'])
                                                ->where('exam_id',$request['exam_id'])
                                                ->where('student_id',$input['student_id'])
                                                ->where('section_id',$request['section_id'])
                                                ->where('group_id',$request['group_id'])
                                                ->where('subject_id',$request['subject_id'])
                                                ->first();
                                            if(empty($fail_subject)) {
                                                if(empty($optional_check) && empty($input['inactive'])) {
                                                    FailSubject::create($input);
                                                }
                                            }

                                        } elseif(empty($request['group_id']) && empty($request['section_id'])) {
                                            $fail_subject = FailSubject::where('sclass_id',$request['sclass_id'])
                                                ->where('exam_id',$request['exam_id'])
                                                ->where('session',$request['session'])
                                                ->where('subject_id',$request['subject_id'])
                                                ->where('student_id',$input['student_id'])
                                                ->first();

                                            if(empty($fail_subject)) {
                                                if(empty($optional_check) && empty($input['inactive'])) {
                                                    FailSubject::create($input);
                                                }
                                            }
                                        }
                                    } else {
                                        if(empty($request['group_id']) && !empty($request['section_id'])){
                                            $fail_subject = FailSubject::where('sclass_id',$request['sclass_id'])
                                                ->where('exam_id',$request['exam_id'])
                                                ->where('session',$request['session'])
                                                ->where('student_id',$input['student_id'])
                                                ->where('section_id',$request['section_id'])
                                                ->where('subject_id',$request['subject_id'])
                                                ->first();
                                            if(!empty($fail_subject)) {
                                                $fail_del = FailSubject::find($fail_subject->id);
                                                $fail_del->delete();
                                            }

                                        } elseif(!empty($request['group_id']) && empty($request['section_id'])) {
                                            $fail_subject = FailSubject::where('sclass_id',$request['sclass_id'])
                                                ->where('exam_id',$request['exam_id'])
                                                ->where('session',$request['session'])
                                                ->where('student_id',$input['student_id'])
                                                ->where('group_id',$request['group_id'])
                                                ->where('subject_id',$request['subject_id'])
                                                ->first();
                                            if(!empty($fail_subject)) {
                                                $fail_del = FailSubject::find($fail_subject->id);
                                                $fail_del->delete();
                                            }

                                        } elseif(!empty($request['group_id']) && !empty($request['section_id'])) {
                                            $fail_subject = FailSubject::where('sclass_id',$request['sclass_id'])
                                                ->where('session',$request['session'])
                                                ->where('exam_id',$request['exam_id'])
                                                ->where('student_id',$input['student_id'])
                                                ->where('section_id',$request['section_id'])
                                                ->where('group_id',$request['group_id'])
                                                ->where('subject_id',$request['subject_id'])
                                                ->first();
                                            if(!empty($fail_subject)) {
                                                $fail_del = FailSubject::find($fail_subject->id);
                                                $fail_del->delete();
                                            }

                                        } elseif(empty($request['group_id']) && empty($request['section_id'])) {
                                            $fail_subject = FailSubject::where('sclass_id',$request['sclass_id'])
                                                ->where('exam_id',$request['exam_id'])
                                                ->where('session',$request['session'])
                                                ->where('subject_id',$request['subject_id'])
                                                ->where('student_id',$input['student_id'])
                                                ->first();

                                            if(!empty($fail_subject)) {
                                                $fail_del = FailSubject::find($fail_subject->id);
                                                $fail_del->delete();
                                            }
                                        }
                                    }
                                }
                            } else if($mark->total_pass == 1) {
                                $total_pass = $mark->sub_pass + $mark->obj_pass + $mark->prac_pass;
                                echo $total_pass."--".$input['total_mark'];
                                if($input['total_mark'] < $total_pass) {
                                    $input['grade'] = "F";
                                    $input['gpa'] = 0;

                                    if(empty($request['group_id']) && !empty($request['section_id'])){
                                        $fail_subject = FailSubject::where('sclass_id',$request['sclass_id'])
                                            ->where('exam_id',$request['exam_id'])
                                            ->where('session',$request['session'])
                                            ->where('student_id',$input['student_id'])
                                            ->where('section_id',$request['section_id'])
                                            ->where('subject_id',$request['subject_id'])
                                            ->first();
                                        if(empty($fail_subject)) {
                                            if(empty($optional_check) && empty($input['inactive'])) {
                                                FailSubject::create($input);
                                            }
                                        }

                                    } elseif(!empty($request['group_id']) && empty($request['section_id'])) {
                                        $fail_subject = FailSubject::where('sclass_id',$request['sclass_id'])
                                            ->where('exam_id',$request['exam_id'])
                                            ->where('session',$request['session'])
                                            ->where('student_id',$input['student_id'])
                                            ->where('group_id',$request['group_id'])
                                            ->where('subject_id',$request['subject_id'])
                                            ->first();
                                        if(empty($fail_subject)) {
                                            if(empty($optional_check) && empty($input['inactive'])) {
                                                FailSubject::create($input);
                                            }
                                        }

                                    } elseif(!empty($request['group_id']) && !empty($request['section_id'])) {
                                        $fail_subject = FailSubject::where('sclass_id',$request['sclass_id'])
                                            ->where('session',$request['session'])
                                            ->where('exam_id',$request['exam_id'])
                                            ->where('student_id',$input['student_id'])
                                            ->where('section_id',$request['section_id'])
                                            ->where('group_id',$request['group_id'])
                                            ->where('subject_id',$request['subject_id'])
                                            ->first();
                                        if(empty($fail_subject)) {
                                            if(empty($optional_check) && empty($input['inactive'])) {
                                                FailSubject::create($input);
                                            }
                                        }

                                    } elseif(empty($request['group_id']) && empty($request['section_id'])) {
                                        $fail_subject = FailSubject::where('sclass_id',$request['sclass_id'])
                                            ->where('exam_id',$request['exam_id'])
                                            ->where('session',$request['session'])
                                            ->where('subject_id',$request['subject_id'])
                                            ->where('student_id',$input['student_id'])
                                            ->first();

                                        if(empty($fail_subject)) {
                                            if(empty($optional_check) && empty($input['inactive'])) {
                                                FailSubject::create($input);
                                            }
                                        }
                                    }
                                } else {
                                    echo $input['total_mark']."-".$mark_limit."<br>";
                                    $grade_info = grade($input['total_mark'],$mark_limit);
                                    $gpa_info = explode("_",$grade_info);
                                    $input['grade'] = $gpa_info[0];
                                    $input['gpa'] = $gpa_info[1];

                                    if($input['grade'] == "F") {
                                        if(empty($request['group_id']) && !empty($request['section_id'])){
                                            $fail_subject = FailSubject::where('sclass_id',$request['sclass_id'])
                                                ->where('exam_id',$request['exam_id'])
                                                ->where('session',$request['session'])
                                                ->where('student_id',$input['student_id'])
                                                ->where('section_id',$request['section_id'])
                                                ->where('subject_id',$request['subject_id'])
                                                ->first();
                                            if(empty($fail_subject)) {
                                                if(empty($optional_check) && empty($input['inactive'])) {
                                                    FailSubject::create($input);
                                                }
                                            }

                                        } elseif(!empty($request['group_id']) && empty($request['section_id'])) {
                                            $fail_subject = FailSubject::where('sclass_id',$request['sclass_id'])
                                                ->where('exam_id',$request['exam_id'])
                                                ->where('session',$request['session'])
                                                ->where('student_id',$input['student_id'])
                                                ->where('group_id',$request['group_id'])
                                                ->where('subject_id',$request['subject_id'])
                                                ->first();
                                            if(empty($fail_subject)) {
                                                if(empty($optional_check) && empty($input['inactive'])) {
                                                    FailSubject::create($input);
                                                }
                                            }

                                        } elseif(!empty($request['group_id']) && !empty($request['section_id'])) {
                                            $fail_subject = FailSubject::where('sclass_id',$request['sclass_id'])
                                                ->where('session',$request['session'])
                                                ->where('exam_id',$request['exam_id'])
                                                ->where('student_id',$input['student_id'])
                                                ->where('section_id',$request['section_id'])
                                                ->where('group_id',$request['group_id'])
                                                ->where('subject_id',$request['subject_id'])
                                                ->first();
                                            if(empty($fail_subject)) {
                                                if(empty($optional_check) && empty($input['inactive'])) {
                                                    FailSubject::create($input);
                                                }
                                            }

                                        } elseif(empty($request['group_id']) && empty($request['section_id'])) {
                                            $fail_subject = FailSubject::where('sclass_id',$request['sclass_id'])
                                                ->where('exam_id',$request['exam_id'])
                                                ->where('session',$request['session'])
                                                ->where('subject_id',$request['subject_id'])
                                                ->where('student_id',$input['student_id'])
                                                ->first();

                                            if(empty($fail_subject)) {
                                                if(empty($optional_check) && empty($input['inactive'])) {
                                                    FailSubject::create($input);
                                                }
                                            }
                                        }
                                    } else {
                                        if(empty($request['group_id']) && !empty($request['section_id'])){
                                            $fail_subject = FailSubject::where('sclass_id',$request['sclass_id'])
                                                ->where('exam_id',$request['exam_id'])
                                                ->where('session',$request['session'])
                                                ->where('student_id',$input['student_id'])
                                                ->where('section_id',$request['section_id'])
                                                ->where('subject_id',$request['subject_id'])
                                                ->first();
                                            if(!empty($fail_subject)) {
                                                $fail_del = FailSubject::find($fail_subject->id);
                                                $fail_del->delete();
                                            }

                                        } elseif(!empty($request['group_id']) && empty($request['section_id'])) {
                                            $fail_subject = FailSubject::where('sclass_id',$request['sclass_id'])
                                                ->where('exam_id',$request['exam_id'])
                                                ->where('session',$request['session'])
                                                ->where('student_id',$input['student_id'])
                                                ->where('group_id',$request['group_id'])
                                                ->where('subject_id',$request['subject_id'])
                                                ->first();
                                            if(!empty($fail_subject)) {
                                                $fail_del = FailSubject::find($fail_subject->id);
                                                $fail_del->delete();
                                            }

                                        } elseif(!empty($request['group_id']) && !empty($request['section_id'])) {
                                            $fail_subject = FailSubject::where('sclass_id',$request['sclass_id'])
                                                ->where('session',$request['session'])
                                                ->where('exam_id',$request['exam_id'])
                                                ->where('student_id',$input['student_id'])
                                                ->where('section_id',$request['section_id'])
                                                ->where('group_id',$request['group_id'])
                                                ->where('subject_id',$request['subject_id'])
                                                ->first();
                                            if(!empty($fail_subject)) {
                                                $fail_del = FailSubject::find($fail_subject->id);
                                                $fail_del->delete();
                                            }

                                        } elseif(empty($request['group_id']) && empty($request['section_id'])) {
                                            $fail_subject = FailSubject::where('sclass_id',$request['sclass_id'])
                                                ->where('exam_id',$request['exam_id'])
                                                ->where('session',$request['session'])
                                                ->where('subject_id',$request['subject_id'])
                                                ->where('student_id',$input['student_id'])
                                                ->first();

                                            if(!empty($fail_subject)) {
                                                $fail_del = FailSubject::find($fail_subject->id);
                                                $fail_del->delete();
                                            }
                                        }
                                    }
                                }
                            }
                        }

                        if(!empty($optional_check)) {
                            if($input['gpa'] > 2) {
                                $input['opt_point'] = $input['gpa'] - 2;
                            } else {
                                $input['opt_point'] = 0;
                            }
                            $input['is_opt'] = 1;
                        } else {
                            $input['is_opt'] = 0;
                            $input['opt_point'] = 0;
                        }

                        $input['teacher_id'] = Auth::guard('teacher')->user()->id;

                        if(!empty($request['section_id'])) {
                            $input['section_id'] = $request['section_id'];
                        }

                        if(!empty($request['group_id'])) {
                            $input['group_id'] = $request['group_id'];
                        }

                        Result::create($input);

//                  Generating Merit And Grade

//                    $results = \App\Result::where('student_id',$student)
//                        ->where('sclass_id',$request['sclass_id'])
//                        ->where('session',$request['session'])
//                        ->where('exam_id',$request['exam_id'])
//                        ->orderBy('subject_id')
//                        ->get();
//
//                    foreach($results as $result)
//                    {
//                        if(empty($result->inactive)) {
//                            if (empty($result->is_opt)) {
//                                if (!empty($result->part)) {
//                                    if ($part != $result->part) {
//                                        $subject_count++;
//                                        $total_points += $result->gpa;
//                                        $total_mark += $result->part_mark;
//                                        $part = $result->part;
//                                    }
//                                } else {
//                                    $subject_count++;
//                                    $total_points += $result->gpa;
//                                    $total_mark += $result->total_mark;
//                                }
//
//                            } else {
//                                $total_points += $result->opt_point;
//                                if ($result->total > 40) {
//                                    $total_mark += $result->total_mark - 40;
//                                }
//                            }
//
//                            if (empty($fail)) {
//                                if (empty($result->is_opt) && $result->grade == "F") {
//                                    $fail = 1;
//                                }
//                            }
//                        }
//                    }
//
//                    $section_id = $request['section_id'];
//                    $group_id = $request['group_id'];
//
////                echo $student."-p:".$total_points."-m: ".$total_mark."-subjec:".$subject_count."<br>";
//
//                    $old_merit = Merit::where('student_id',$student)
//                        ->where('sclass_id',$request['sclass_id'])
//                        ->where('session',$request['session'])
//                        ->where('exam_id',$request['exam_id'])
//                        ->first();
//
//                    if($fail == 1) {
//                        if(empty($old_merit)) {
//                            $merit = Merit::create(['student_id' => $student,'student_id' => Student::find($student)->roll,'sclass_id' => $request['sclass_id'],'exam_id' => $request['exam_id'],'section_id' => $section_id,'group_id' => $group_id,'session' => $request['session'],'total_mark' => $total_mark,'gpa' => '0','grade' => 'F','fail' => 1,'pass' => 0]);
//                        } else {
//                            $merit = Merit::find($old_merit->id);
//                            $merit->update(['student_id' => $student,'student_id' => Student::find($student)->roll,'sclass_id' => $request['sclass_id'],'exam_id' => $request['exam_id'],'section_id' => $section_id,'group_id' => $group_id,'session' => $request['session'],'total_mark' => $total_mark,'gpa' => $total_gpa,'grade' => 'F','fail' => 1,'pass' => 0]);
//                        }
//                    } else {
//                        $total_gpa = round(($total_points/$subject_count),2);
//                        if($total_gpa >= 5) {
//                            $total_gpa = 5.00;
//                        }
//                        $total_grade = gpa($total_gpa);
//                        if(empty($old_merit)) {
//                            $merit = Merit::create(['student_id' => $student,'student_id' => Student::find($student)->roll,'sclass_id' => $request['sclass_id'],'exam_id' => $request['exam_id'],'section_id' => $section_id,'group_id' => $group_id,'session' => $request['session'],'total_mark' => $total_mark,'gpa' => $total_gpa,'grade' => $total_grade,'pass' => 1,'fail' => 0]);
//                        } else {
//                            $merit = Merit::find($old_merit->id);
//                            $merit->update(['student_id' => $student,'student_id' => Student::find($student)->roll,'sclass_id' => $request['sclass_id'],'exam_id' => $request['exam_id'],'section_id' => $section_id,'group_id' => $group_id,'session' => $request['session'],'total_mark' => $total_mark,'gpa' => $total_gpa,'grade' => $total_grade,'pass' => 1,'fail' => 0]);
//                        }
//                    }
//
//                    $total_mark = 0;
//                    $subject_count = 0;
//                    $total_points = 0;
//                    $fail = 0;
//                    $total_gpa = 0;
//                    $total_grade = 0;
//                    $part = "";
                    } else {
                        $mark_acceed[] = $student;
                    }
                }


            }
        }

        return redirect('/add/result')->with([
           'success' => 'Operation Successfull'
        ]);
    }

    public function generatePage()
    {
        $classes = Auth::guard('teacher')->user()->classes;
        $subjects = Auth::guard('teacher')->user()->subjects;
        return view('Teacher.result.generate_page',compact('classes','subjects'));
    }

    public function getStudentsGenerate(Request $request)
    {

        $request['section_id'] = empty($request['section_id']) ? null : $request['section_id'];
        $request['group_id'] = empty($request['group_id']) ? null : $request['group_id'];

        $class_id = $request['sclass_id'];
        $exam_id = $request['exam_id'];
        $session = $request['session'];
        $section_id = $request['section_id'];
        $group_id = $request['group_id'];

//        return $request->all();
        $students = Result::select(DB::raw('distinct student_id'))
            ->where('sclass_id',$request['sclass_id'])
            ->where('group_id',$request['group_id'])
            ->where('section_id',$request['section_id'])
            ->where('session',$request['session'])
            ->where('exam_id',$request['exam_id'])
            ->orderBy('student_id')
            ->get();

        return view('Teacher.result.generate_page', compact('students','class_id','exam_id','session','section_id','group_id'));
    }

    public function generateMerit(Request $request)
    {
        $this->validate($request,[
            'students' => 'required'
        ]);

//        return $request->all();

        $total_mark = 0;
        $is_golden = 0;
        $subject_count = 0;
        $total_points = 0;
        $fail = 0;
        $total_gpa = 0;
        $total_grade = 0;
        $optional_point = 0;
        $part = "";

        $monthlies = \App\ClassExam::where('sclass_id',$request['sclass_id'])->where('type','monthly')->get();

        foreach($request['students'] as $student) {

            $results = Result::where('student_id',$student)
                ->where('sclass_id',$request['sclass_id'])
                ->where('session',$request['session'])
                ->where('exam_id',$request['exam_id'])
                ->orderBy('subject_id')
                ->get();

            $fail_subjects = FailSubject::where('student_id',$student)
                ->where('sclass_id',$request['sclass_id'])
                ->where('session',$request['session'])
                ->where('exam_id',$request['exam_id'])
                ->orderBy('subject_id')
                ->get();

            $has_monthly = 0;



            foreach($results as $result)
            {
                if(empty($result->inactive)) {

                    if(empty($has_monthly)) {
                        if(!empty($result->has_monthly)) {
                            $has_monthly = 1;
                        }
                    }
                    if (empty($result->is_opt)) {
                        if (!empty($result->part)) {
                            if ($part != $result->part) {
                                $subject_count++;
                                $total_points += $result->gpa;
                                $total_mark += $result->part_mark;
                                $part = $result->part;
                            }
                        } else {
                            $subject_count++;
                            $total_points += $result->gpa;
                            $total_mark += $result->total_mark;
                        }

                    } else {
                        $total_points += $result->opt_point;
                        $optional_point = $result->opt_point;
                        if ($result->total > 40) {
                            $total_mark += $result->total_mark - 40;
                        }
                    }

                    if (empty($fail)) {
                        if (empty($result->is_opt) && $result->grade == "F") {
                            $fail = 1;
                        }
                    }
                }
            }

            $section_id = $request['section_id'];
            $group_id = $request['group_id'];

//                echo $student."-p:".$total_points."-m: ".$total_mark."-subjec:".$subject_count."<br>";

            $old_merit = Merit::where('student_id',$student)
                ->where('sclass_id',$request['sclass_id'])
                ->where('session',$request['session'])
                ->where('exam_id',$request['exam_id'])
                ->first();

            if($fail == 1) {
                if(empty($old_merit)) {
                    $merit = Merit::create(['student_id' => $student,'student_roll' => Student::find($student)->roll,'sclass_id' => $request['sclass_id'],'exam_id' => $request['exam_id'],'section_id' => $section_id,'group_id' => $group_id,'session' => $request['session'],'total_mark' => $total_mark,'gpa' => '0','grade' => 'F','fail' => 1,'fail_subjects' => count($fail_subjects),'pass' => 0,'has_monthly' => $has_monthly]);
                } else {
                    $merit = Merit::find($old_merit->id);
                    $merit->update(['student_id' => $student,'student_roll' => Student::find($student)->roll,'sclass_id' => $request['sclass_id'],'exam_id' => $request['exam_id'],'section_id' => $section_id,'group_id' => $group_id,'session' => $request['session'],'total_mark' => $total_mark,'gpa' => $total_gpa,'grade' => 'F','fail' => 1,'fail_subjects' => count($fail_subjects),'pass' => 0,'has_monthly' => $has_monthly]);
                }
            } else {
                $total_gpa = round(($total_points/$subject_count),2);
                $check_golden = $total_points - $optional_point;
                $without_optional_gpa = round(($check_golden/$subject_count), 2);

                if($without_optional_gpa >= 5) {
                    $is_golden = 1;
                }

                if($total_gpa >= 5) {
                    $total_gpa = $total_gpa;
                }

                $total_grade = gpa($total_gpa);
                if(empty($old_merit)) {
                    $merit = Merit::create(['student_id' => $student,'student_roll' => Student::find($student)->roll,'sclass_id' => $request['sclass_id'],'exam_id' => $request['exam_id'],'section_id' => $section_id,'group_id' => $group_id,'session' => $request['session'],'total_mark' => $total_mark,'gpa' => $total_gpa,'grade' => $total_grade,'pass' => 1,'fail' => 0,'fail_subjects' => 0,'is_golden' => $is_golden,'wo_gpa' => $without_optional_gpa,'has_monthly' => $has_monthly]);
                } else {
                    $merit = Merit::find($old_merit->id);
                    $merit->update(['student_id' => $student,'student_roll' => Student::find($student)->roll,'sclass_id' => $request['sclass_id'],'exam_id' => $request['exam_id'],'section_id' => $section_id,'group_id' => $group_id,'session' => $request['session'],'total_mark' => $total_mark,'gpa' => $total_gpa,'grade' => $total_grade,'pass' => 1,'fail' => 0,'fail_subjects' => 0,'is_golden' => $is_golden,'wo_gpa' => $without_optional_gpa,'has_monthly' => $has_monthly]);
                }
            }

            $total_mark = 0;
            $subject_count = 0;
            $total_points = 0;
            $fail = 0;
            $total_gpa = 0;
            $total_grade = 0;
            $part = "";
        }

        $merits = Merit::where('sclass_id',$request['sclass_id'])
            ->where('exam_id',$request['exam_id'])
            ->where('group_id',$request['group_id'])
            ->where('section_id',$request['section_id'])
            ->where('session',$request['session'])
            ->where('pass',1)
            ->orderBy('gpa','desc')
            ->orderBy('total_mark','desc')
            ->orderBy('student_id','asc')
            ->get();

        $count = 0;
        foreach($merits as $merit) {
            $count++;
            $merit->update(['position' => $count]);
//            if($request['promotion'] == 1) {
//                $std = Student::find($merit->student_id);
//                $std->update(['sclass_id' => $std->sclass_id+1,'roll' => $count]);
//            }
        }

        $demerits = Merit::where('sclass_id',$request['sclass_id'])
            ->where('exam_id',$request['exam_id'])
            ->where('session',$request['session'])
            ->where('group_id',$request['group_id'])
            ->where('section_id',$request['section_id'])
            ->where('fail',1)
            ->orderBy('fail_subjects','asc')
            ->orderBy('total_mark','desc')
            ->orderBy('student_id','asc')
            ->get();

        foreach($demerits as $demerit) {
            $count++;
            $demerit->update(['position' => $count]);
//            if($request['promotion'] == 1) {
//                $std = Student::find($demerit->student_id);
//                $std->update(['sclass_id' => $std->sclass_id+1,'roll' => $count]);
//            }
        }
        
        $merits = Merit::where('sclass_id',$request['sclass_id'])
            ->where('exam_id',$request['exam_id'])
            ->where('session',$request['session'])
            ->where('pass',1)
            ->orderBy('gpa','desc')
            ->orderBy('total_mark','desc')
            ->orderBy('student_roll','asc')
            ->get();

        $count = 0;
        foreach($merits as $merit) {
            $count++;
            $merit->update(['class_position' => $count]);
        }

        $demerits = Merit::where('sclass_id',$request['sclass_id'])
            ->where('exam_id',$request['exam_id'])
            ->where('session',$request['session'])
            ->where('fail',1)
            ->orderBy('fail_subjects','asc')
            ->orderBy('total_mark','desc')
            ->orderBy('student_roll','asc')
            ->get();

        foreach($demerits as $demerit) {
            $count++;
            $demerit->update(['class_position' => $count]);
        }

        return redirect('/generate/merit/students')->with([
            'success' => 'Merit List Generated'
        ]);


    }


    public function updateResult()
    {
        $classes = Auth::guard('teacher')->user()->classes;
        $subjects = Auth::guard('teacher')->user()->subjects;
        return view('Teacher.result.update_result',compact('classes','subjects'));
    }

    public function getStudentsMarksEdit(Request $request)
    {
        $class_id = $request['sclass_id'];
        $section_id = $request['section_id'];
        $group_id = $request['group_id'];
        $exam_id = $request['exam_id'];
        $subject_id = $request['subject_id'];
        $session = $request['session'];
        $students = Result::where('sclass_id',$request['sclass_id'])
            ->where('session',$request['session'])
            ->where('section_id',$request['section_id'])
            ->where('group_id',$request['group_id'])
            ->where('subject_id',$request['subject_id'])
            ->where('exam_id',$request['exam_id'])
            ->orderBy('student_id')
            ->get();

        $mark = ClassSubject::where('sclass_id',$request['sclass_id'])
            ->where('exam_id',$request['exam_id'])
            ->where('group_id',$request['group_id'])
            ->where('subject_id',$request['subject_id'])
            ->first();

        return view('Teacher.result.mark_update',compact('students','mark','class_id','section_id','group_id','exam_id','subject_id','session'));
    }

    public function viewResultInformation()
    {
        return view('admin.result.view_result_information');
    }

    public function getResultInformation(Request $request)
    {
        $class_id = $request['sclass_id'];
        $exam_id = $request['exam_id'];
        $session = $request['session'];
        $section_id = $request['section_id'];
        $group_id = $request['group_id'];
        $merits = Merit::where('sclass_id',$request['sclass_id'])
            ->where('session',$request['session'])
            ->where('exam_id',$request['exam_id'])
            ->where('section_id',$request['section_id'])
            ->where('group_id',$request['group_id'])
            ->where('pass',1)
            ->orderBy('student_id','asc')
            ->get();

        $demerits = Merit::where('sclass_id',$request['sclass_id'])
            ->where('session',$request['session'])
            ->where('exam_id',$request['exam_id'])
            ->where('section_id',$request['section_id'])
            ->where('group_id',$request['group_id'])
            ->where('fail',1)
            ->orderBy('student_id','asc')
            ->get();

        return view('admin.result.view_result_information',compact('merits','demerits','class_id','exam_id','session','section_id','group_id'));
    }

    public function getPromotion()
    {
        return view('admin.result.get_promotion');
    }

    public function getPromotionStudents(Request $request)
    {
        $class_id = $request['sclass_id'];
        $exam_id = $request['exam_id'];
        $session = $request['session'];
        $section_id = $request['section_id'];
        $group_id = $request['group_id'];

        if($request['status'] == 1) {
            $results = Merit::where('sclass_id',$request['sclass_id'])
                ->where('session',$request['session'])
                ->where('exam_id',$request['exam_id'])
                ->where('section_id',$request['section_id'])
                ->where('group_id',$request['group_id'])
                ->where('pass',1)
                ->orderBy('position')
                ->get();
            $status = "Passed Students";
        } else if($request['status'] == 2) {
            $results = Merit::where('sclass_id',$request['sclass_id'])
                ->where('session',$request['session'])
                ->where('exam_id',$request['exam_id'])
                ->where('section_id',$request['section_id'])
                ->where('group_id',$request['group_id'])
                ->where('fail',1)
                ->orderBy('position')
                ->get();
            $status = "Failed Students";
        } else {
            $results = Merit::where('sclass_id',$request['sclass_id'])
                ->where('session',$request['session'])
                ->where('exam_id',$request['exam_id'])
                ->where('section_id',$request['section_id'])
                ->where('group_id',$request['group_id'])
                ->orderBy('position')
                ->get();
            $status = "Pass and Failed Students";
        }


        return view('admin.result.set_promotion',compact('results','class_id','exam_id','session','section_id','group_id','status'));
    }

    public function setPromotion(Request $request)
    {
        foreach($request['students'] as $student) {
            $merit = Merit::find($student);
            Student::find($merit->student_id)->update(['sclass_id' => $merit->sclass_id+1,'roll' => $merit->position]);
        }

        return redirect()->back()->with([
            'success' => 'Promotion Successfull'
        ]);
    }

    public function getPrintMark()
    {
        $classes = Auth::guard('teacher')->user()->classes;
        $subjects = Auth::guard('teacher')->user()->subjects;
        return view('Teacher.result.print_mark',compact('classes','subjects'));
    }

    public function printMark(Request $request)
    {
        $class_id = $request['sclass_id'];
        $section_id = $request['section_id'];
        $group_id = $request['group_id'];
        $exam_id = $request['exam_id'];
        $subject_id = $request['subject_id'];
        $session = $request['session'];
        $status = $request['status'];
        $marks = Result::where('sclass_id',$request['sclass_id'])
            ->where('section_id',$request['section_id'])
            ->where('group_id',$request['group_id'])
            ->where('exam_id',$request['exam_id'])
            ->where('session',$request['session'])
            ->where('subject_id',$request['subject_id'])
            ->get();
        return view('Teacher.result.print_mark',compact('marks','class_id','exam_id','session','section_id','group_id','subject_id','status'));
    }

    public function deletemark(Request $request)
    {
        foreach($request['marks'] as $mark) {
            $result = Result::find($mark);
            $result->delete();
        }
        return redirect()->back()->with([
            'success' => 'Mark Deleted'
        ]);
    }


    //Single Mark Entry

    public function addSingleResult()
    {
        $classes = Auth::guard('teacher')->user()->classes;
        return view('Teacher.result.add_single_result',compact('classes'));
    }

    public function getSingleStudentsMarks(Request $request)
    {

        $this->validate($request,[
            'sclass_id' => 'required',
            'session' => 'required',
        ]);



        $class_id = $request['sclass_id'];
        $section_id = $request['section_id'];
        $group_id = $request['group_id'];
        $exam_id = $request['exam_id'];
        $subject_id = $request['subject_id'];
        $session = $request['session'];

        if(!empty($request['group_id'])) {
            $subjects = ClassSubject::where('sclass_id',$request['sclass_id'])
                ->where('exam_id',$request['exam_id'])
                ->where('group_id',$request['group_id'])
                ->get();
        } else {
            $subjects = ClassSubject::where('sclass_id',$request['sclass_id'])
                ->where('exam_id',$request['exam_id'])
                ->get();
        }

        $student = Student::where('sclass_id',$request['sclass_id'])
            ->where('session',$request['session'])
            ->where('section_id',$request['section_id'])
            ->where('group_id',$request['group_id'])
            ->where('roll',$request['roll'])
            ->first();


        return view('Teacher.result.mark_insert_single',compact('student','subjects','class_id','section_id','group_id','exam_id','session'));
    }

    public function storeSingle(Request $request)
    {
//        return $request->all();


        $exam_id = Exam::find($request['exam_id']);

        if(!empty($request['group_id'])) {
            $subjects = ClassSubject::where('sclass_id',$request['sclass_id'])
                ->where('exam_id',$request['exam_id'])
                ->where('group_id',$request['group_id'])
                ->get();
        } else {
            $subjects = ClassSubject::where('sclass_id',$request['sclass_id'])
                ->where('exam_id',$request['exam_id'])
                ->get();
        }

        if($exam_id->type == "monthly") {
            $mark = ClassSubject::where('sclass_id',$request['sclass_id'])->where('exam_id',$request['exam_id'])->where('subject_id',$request['subject_id'])->first();
            foreach($request['students'] as $student) {
                $stu = Student::find($student);
                $input['section_id'] = $stu->section_id;
                if($request['sub'][$student] <= $mark->subjective && $request['obj'][$student] <= $mark->objective && $request['prac'][$student] <= $mark->practical) {
                    $input['student_id'] = Student::find($student)->roll;
                    if (!empty($request['id'][$student])) {
                        $result = Result::find($request['id'][$student]);
                        $result->delete();
                    }
                    $input['student_id'] = $student;
                    $input['subjective'] = ceil($request['sub'][$student]);
                    $input['objective'] = ceil($request['obj'][$student]);
                    $input['practical'] = ceil($request['prac'][$student]);
                    $input['total'] = $request['sub'][$student] + $request['obj'][$student] + $request['prac'][$student];
                    $input['total_mark'] = $input['total'];
                    $input['percent'] = $input['total'];


                    $input['teacher_id'] = Auth::guard('teacher')->user()->id;
                    Result::create($input);
                }
            }
        } else if($exam_id->type == "normal") {

            $total_points = 0;
            $subject_count = 0;
            $fail = 0;
            $total_mark = 0;
            $total_gpa = 0;
            $total_grade = 0;
            $old_merit = 0;
            $part = "";

            foreach($subjects as $st) {
                $student = $st->subject_id;
                $input['sclass_id'] = $request['sclass_id'];
                $input['section_id'] = $request['section_id'];
                $input['group_id'] = $request['group_id'];
                $input['exam_id'] = $request['exam_id'];
                $input['session'] = $request['session'];
                $input['subject_id'] = $student;

                $mark = ClassSubject::where('sclass_id',$request['sclass_id'])->where('group_id',$request['group_id'])->where('exam_id',$request['exam_id'])->where('subject_id',$student)->first();
                if(!empty($mark->part)) {
                    $part_pass = ClassSubject::select(DB::raw('sum(sub_pass) as sub_pass,sum(obj_pass) as obj_pass,sum(percent) as percent,sum(subjective) as sub,sum(objective) as obj,sum(practical) as prac'))->where('sclass_id',$request['sclass_id'])->where('exam_id',$request['exam_id'])->where('group_id',$request['group_id'])->where('part',$mark->part)->first();
                }


                if(!empty($mark->inactive)) {
                    $input['inactive'] = 1;
                } else {
                    $input['inactive'] = 0;
                }

                if(!isset($request['non'][$student])) {

                    if($request['sub'][$student] <= $mark->subjective && $request['obj'][$student] <= $mark->objective && $request['prac'][$student] <= $mark->practical) {
                        $input['student_id'] = Student::find($request['student_id'])->roll;
//                        if(!empty($request['id'][$student])) {
//                            $result = Result::find($request['id'][$student]);
//                            $result->delete();
//                        }
                        $optional_check = OptionalSubject::where('student_id',$request['student_id'])->where('sclass_id',$request['sclass_id'])->where('session',$request['session'])->where('subject_id',$student)->first();
                        $fail_subject = FailSubject::where('sclass_id',$request['sclass_id'])
                            ->where('session',$request['session'])
                            ->where('exam_id',$request['exam_id'])
                            ->where('student_id',$input['student_id'])
                            ->where('section_id',$request['section_id'])
                            ->where('group_id',$request['group_id'])
                            ->where('subject_id',$student)
                            ->first();
                        $input['student_id'] = $request['student_id'];
                        $input['subjective'] = ceil($request['sub'][$student]);
                        $input['objective'] = ceil($request['obj'][$student]);
                        $input['practical'] = ceil($request['prac'][$student]);

                        $input['total'] = $request['sub'][$student] + $request['obj'][$student] + $request['prac'][$student];
//                        echo $input['total'];
                        $total_exam_mark = $mark->subjective+$mark->objective+$mark->practical;
                        $input['percent'] = $input['total'] * $mark->percent / $total_exam_mark ;
                        $input['percent'] = ceil($input['percent']);


                        if(!empty($request['monthly'][$student])) {
                            $monthly = $request['monthly'][$student];
                            $monthly_limit = $total_exam_mark - $mark->percent;
                            $input['monthly'] = ($monthly * $monthly_limit)/$request['limit'][$student];
                            $input['monthly'] = ceil($input['monthly']);
                            $input['total_mark'] = $input['percent'] + $input['monthly'];
                        } else {
                            $input['total_mark'] = $input['percent'];
                        }

                        $input['is_sub_pass'] = $input['subjective'] < $mark->sub_pass ? 1 : 0;
                        $input['is_obj_pass'] = $input['objective'] < $mark->obj_pass ? 1 : 0;
                        $input['is_prac_pass'] = $input['practical'] < $mark->prac_pass ? 1 : 0;

                        if(!empty($mark->part)) {
                            $mark_limit = $part_pass->sub + $part_pass->obj + $part_pass->prac;
                            $part_mark = Result::where("student_id",$request['student_id'])
                                ->where('sclass_id',$request['sclass_id'])
                                ->where('exam_id',$request['exam_id'])
                                ->where('session',$request['session'])
                                ->where('part',$mark->part)
                                ->first();

                            if(!empty($request['monthly'][$student])) {
                                $input['part_monthly'] = $input['monthly'];
                            }

                            $input['part_sub'] = $input['subjective'];
                            $input['part_obj'] = $input['objective'];
                            $input['part_prac'] = $input['practical'];
                            $input['part_mark'] = $input['total_mark'];
                            $input['part'] = $mark->part;

                            if(!empty($part_mark)) {
                                $old_part = Result::find($part_mark->id);

                                if(!empty($request['monthly'][$student])) {
                                    $input['part_monthly'] += $part_mark->monthly;
                                }
                                $input['part_sub'] += $part_mark->subjective;
                                $input['part_obj'] += $part_mark->objective;
                                $input['part_prac'] += $part_mark->practical;
                                $input['part_mark'] += $part_mark->total_mark;
                            }

                            if(empty($mark->total_pass) && empty($mark->single_pass)) {
                                if($input['part_sub'] < $part_pass->sub_pass || $input['part_obj'] < $part_pass->obj_pass) {
                                    if(!empty($old_part)) {
                                        if(!empty($request['monthly'][$student])) {
                                            $old_part->update(['part_monthly' => $input['part_monthly'],'part_sub' => $input['part_sub'], "part_obj" => $input['part_obj'], "part_prac" => $input['part_prac'], "part_mark" => $input['part_mark'], 'grade' => 'F', 'gpa' => '0.00']);
                                        } else {
                                            $old_part->update(['part_sub' => $input['part_sub'], "part_obj" => $input['part_obj'], "part_prac" => $input['part_prac'], "part_mark" => $input['part_mark'], 'grade' => 'F', 'gpa' => '0.00']);
                                        }
                                    }
                                    $input['grade'] = "F";
                                    $input['gpa'] = 0;


                                    if(empty($fail_subject)) {
                                        if(empty($optional_check) && empty($input['inactive'])) {
                                            FailSubject::create($input);
                                        }
                                    }

                                } else {
                                    echo $input['part_mark']."-".$mark_limit."<br>";
                                    $grade_info = grade($input['part_mark'],$mark_limit);
                                    $gpa_info = explode("_",$grade_info);
                                    $input['grade'] = $gpa_info[0];
                                    $input['gpa'] = $gpa_info[1];

                                    echo "wro";


                                    if(!empty($fail_subject)) {
                                        $fail_del = FailSubject::find($fail_subject->id);
                                        $fail_del->delete();
                                    }

                                    if(!empty($old_part)) {
                                        if(!empty($request['monthly'][$student])) {
                                            $old_part->update(['part_monthly' => $input['part_monthly'],'part_sub' => $input['part_sub'], "part_obj" => $input['part_obj'], "part_prac" => $input['part_prac'], "part_mark" => $input['part_mark'], 'grade' => $input['grade'], 'gpa' => $input['gpa']]);
                                        } else {
                                            echo "working<br>";
                                            $old_part->update(['part_sub' => $input['part_sub'], "part_obj" => $input['part_obj'], "part_prac" => $input['part_prac'], "part_mark" => $input['part_mark'], 'grade' => $input['grade'], 'gpa' => $input['gpa']]);
                                        }
                                    }
                                }
                            } else if($mark->single_pass == 1 && $mark->total_pass != 1) {

                                if(!empty($input['is_sub_pass']) || !empty($input['is_obj_pass']) || !empty($input['is_prac_pass'])) {

                                    if(!empty($old_part)) {
                                        if(!empty($request['monthly'][$student])) {
                                            $old_part->update(['part_monthly' => $input['part_monthly'],'part_sub' => $input['part_sub'], "part_obj" => $input['part_obj'], "part_prac" => $input['part_prac'], "part_mark" => $input['part_mark'], 'grade' => 'F', 'gpa' => '0.00']);
                                        } else {
                                            $old_part->update(['part_sub' => $input['part_sub'], "part_obj" => $input['part_obj'], "part_prac" => $input['part_prac'], "part_mark" => $input['part_mark'], 'grade' => 'F', 'gpa' => '0.00']);
                                        }
                                    }
                                    $input['grade'] = "F";
                                    $input['gpa'] = 0;

                                    if(empty($fail_subject)) {
                                        if(empty($optional_check) && empty($input['inactive'])) {
                                            FailSubject::create($input);
                                        }
                                    }

                                } else {
                                    echo $input['part_mark']."-".$mark_limit."<br>";
                                    $grade_info = grade($input['part_mark'],$mark_limit);
                                    $gpa_info = explode("_",$grade_info);
                                    $input['grade'] = $gpa_info[0];
                                    $input['gpa'] = $gpa_info[1];

                                    if(!empty($fail_subject)) {
                                        $fail_del = FailSubject::find($fail_subject->id);
                                        $fail_del->delete();
                                    }

                                    if(!empty($old_part)) {
                                        if(!empty($request['monthly'][$student])) {
                                            $old_part->update(['part_monthly' => $input['part_monthly'],'part_sub' => $input['part_sub'], "part_obj" => $input['part_obj'], "part_prac" => $input['part_prac'], "part_mark" => $input['part_mark'], 'grade' => $input['grade'], 'gpa' => $input['gpa']]);
                                        } else {
                                            $old_part->update(['part_sub' => $input['part_sub'], "part_obj" => $input['part_obj'], "part_prac" => $input['part_prac'], "part_mark" => $input['part_mark'], 'grade' => $input['grade'], 'gpa' => $input['gpa']]);
                                        }
                                    }
                                }
                            } else {
                                $total_pass = $part_pass->sub_pass + $part_pass->obj_pass;
                                echo $total_pass."-".$input['part_mark']."<br>";
                                if($input['part_mark'] < $total_pass) {
                                    if(!empty($old_part)) {
                                        if(!empty($request['monthly'][$student])) {
                                            $old_part->update(['part_monthly' => $input['part_monthly'],'part_sub' => $input['part_sub'], "part_obj" => $input['part_obj'], "part_prac" => $input['part_prac'], "part_mark" => $input['part_mark'], 'grade' => 'F', 'gpa' => '0.00']);
                                        } else {
                                            $old_part->update(['part_sub' => $input['part_sub'], "part_obj" => $input['part_obj'], "part_prac" => $input['part_prac'], "part_mark" => $input['part_mark'], 'grade' => 'F', 'gpa' => '0.00']);
                                        }
                                    }
                                    $input['grade'] = "F";
                                    $input['gpa'] = 0;

                                    if(empty($fail_subject)) {
                                        if(empty($optional_check) && empty($input['inactive'])) {
                                            FailSubject::create($input);
                                        }
                                    }

                                } else {
                                    echo $input['part_mark']."-".$mark_limit."<br>";
                                    $grade_info = grade($input['part_mark'],$mark_limit);
                                    $gpa_info = explode("_",$grade_info);
                                    $input['grade'] = $gpa_info[0];
                                    $input['gpa'] = $gpa_info[1];


                                    if(!empty($fail_subject)) {
                                        $fail_del = FailSubject::find($fail_subject->id);
                                        $fail_del->delete();
                                    }






                                    if(!empty($old_part)) {

                                        if(!empty($request['monthly'][$student])) {
                                            $old_part->update(['part_monthly' => $input['part_monthly'],'part_sub' => $input['part_sub'], "part_obj" => $input['part_obj'], "part_prac" => $input['part_prac'], "part_mark" => $input['part_mark'], 'grade' => $input['grade'], 'gpa' => $input['gpa']]);
                                        } else {
                                            echo "subject-id ". $input['part_mark']."<br>";
                                            if($old_part->update(['part_sub' => $input['part_sub'], "part_obj" => $input['part_obj'], "part_prac" => $input['part_prac'], "part_mark" => $input['part_mark'], 'grade' => $input['grade'], 'gpa' => $input['gpa']])) {
                                                echo "<br>updated<br>";
                                            }
                                        }
                                    }
                                }
                            }


                        } else { // End of part calculation
                            $mark_limit = $mark->subjective + $mark->objective + $mark->practical;
//                            echo $mark_limit."-".$input['total_mark']."<br>";
                            if($mark->single_pass == 1) {
                                if(!empty($input['is_sub_pass']) || !empty($input['is_obj_pass']) || !empty($input['is_prac_pass'])) {
                                    $input['grade'] = "F";
                                    $input['gpa'] = 0;

                                    if(empty($fail_subject)) {
                                        if(empty($optional_check) && empty($input['inactive'])) {
                                            FailSubject::create($input);
                                        }
                                    }
                                } else {
                                    echo $input['total_mark']."-".$mark_limit."<br>";
                                    $grade_info = grade($input['total_mark'],$mark_limit);
                                    $gpa_info = explode("_",$grade_info);
                                    $input['grade'] = $gpa_info[0];
                                    $input['gpa'] = $gpa_info[1];

                                    if($input['grade'] == "F") {
                                        if(empty($fail_subject)) {
                                            if(empty($optional_check) && empty($input['inactive'])) {
                                                FailSubject::create($input);
                                            }
                                        }
                                    } else {
                                        if(!empty($fail_subject)) {
                                            $fail_del = FailSubject::find($fail_subject->id);
                                            $fail_del->delete();
                                        }
                                    }
                                }
                            } else if($mark->total_pass == 1) {
                                $total_pass = $mark->sub_pass + $mark->obj_pass + $mark->prac_pass;
                                echo $total_pass."--".$input['total_mark'];
                                if($input['total_mark'] < $total_pass) {
                                    $input['grade'] = "F";
                                    $input['gpa'] = 0;

                                    if(empty($fail_subject)) {
                                        if(empty($optional_check) && empty($input['inactive'])) {
                                            FailSubject::create($input);
                                        }
                                    }
                                } else {
                                    echo $input['total_mark']."-".$mark_limit."<br>";
                                    $grade_info = grade($input['total_mark'],$mark_limit);
                                    $gpa_info = explode("_",$grade_info);
                                    $input['grade'] = $gpa_info[0];
                                    $input['gpa'] = $gpa_info[1];

                                    if($input['grade'] == "F") {
                                        if(empty($fail_subject)) {
                                            if(empty($optional_check) && empty($input['inactive'])) {
                                                FailSubject::create($input);
                                            }
                                        }
                                    } else {
                                        if(!empty($fail_subject)) {
                                            $fail_del = FailSubject::find($fail_subject->id);
                                            $fail_del->delete();
                                        }
                                    }
                                }
                            }
                        }

                        if(!empty($optional_check)) {
                            if($input['gpa'] > 2) {
                                $input['opt_point'] = $input['gpa'] - 2;
                            } else {
                                $input['opt_point'] = 0;
                            }
                            $input['is_opt'] = 1;
                        } else {
                            $input['is_opt'] = 0;
                            $input['opt_point'] = 0;
                        }

                        $input['teacher_id'] = Auth::guard('teacher')->user()->id;

                        if(!empty($request['section_id'])) {
                            $input['section_id'] = $request['section_id'];
                        }

                        if(!empty($request['group_id'])) {
                            $input['group_id'] = $request['group_id'];
                        }

                        Result::create($input);

                    } else {
                        $mark_acceed[] = $student;
                    }
                }

                $input = array();
                $old_part = 0;

            }
        }

        //        return $request->all();

        $total_mark = 0;
        $is_golden = 0;
        $subject_count = 0;
        $total_points = 0;
        $fail = 0;
        $total_gpa = 0;
        $total_grade = 0;
        $optional_point = 0;
        $part = "";


        $results = Result::where('student_id',$request['student_id'])
            ->where('sclass_id',$request['sclass_id'])
            ->where('session',$request['session'])
            ->where('exam_id',$request['exam_id'])
            ->orderBy('subject_id')
            ->get();

        $fail_subjects = FailSubject::where('student_id',$request['student_id'])
            ->where('sclass_id',$request['sclass_id'])
            ->where('session',$request['session'])
            ->where('exam_id',$request['exam_id'])
            ->orderBy('subject_id')
            ->get();



        foreach($results as $result)
        {
            if(empty($result->inactive)) {
                if (empty($result->is_opt)) {
                    if (!empty($result->part)) {
                        if ($part != $result->part) {
                            $subject_count++;
                            $total_points += $result->gpa;
                            $total_mark += $result->part_mark;
                            $part = $result->part;
                        }
                    } else {
                        $subject_count++;
                        $total_points += $result->gpa;
                        $total_mark += $result->total_mark;
                    }

                } else {
                    $total_points += $result->opt_point;
                    $optional_point = $result->opt_point;
                    $total_mark += $result->total_mark;
                }

                if (empty($fail)) {
                    if (empty($result->is_opt) && $result->grade == "F") {
                        $fail = 1;
                    }
                }
            }
        }

        $section_id = $request['section_id'];
        $group_id = $request['group_id'];

//                echo $student."-p:".$total_points."-m: ".$total_mark."-subjec:".$subject_count."<br>";

        $old_merit = Merit::where('student_id',$request['student_id'])
            ->where('sclass_id',$request['sclass_id'])
            ->where('session',$request['session'])
            ->where('exam_id',$request['exam_id'])
            ->first();

        if($fail == 1) {
            if(empty($old_merit)) {
                $merit = Merit::create(['student_id' => $student,'student_id' => Student::find($request['student_id'])->roll,'sclass_id' => $request['sclass_id'],'exam_id' => $request['exam_id'],'section_id' => $section_id,'group_id' => $group_id,'session' => $request['session'],'total_mark' => $total_mark,'gpa' => '0','grade' => 'F','fail' => 1,'fail_subjects' => count($fail_subjects),'pass' => 0]);
            } else {
                $merit = Merit::find($old_merit->id);
                $merit->update(['student_id' => $request['student_id'],'student_id' => Student::find($request['student_id'])->roll,'sclass_id' => $request['sclass_id'],'exam_id' => $request['exam_id'],'section_id' => $section_id,'group_id' => $group_id,'session' => $request['session'],'total_mark' => $total_mark,'gpa' => $total_gpa,'grade' => 'F','fail' => 1,'fail_subjects' => count($fail_subjects),'pass' => 0]);
            }
        } else {
            $total_gpa = round(($total_points/$subject_count),2);
            $check_golden = $total_points - $optional_point;
            $without_optional_gpa = round(($check_golden/$subject_count), 2);

            if($without_optional_gpa >= 5) {
                $is_golden = 1;
            }

            if($total_gpa >= 5) {
                $total_gpa = $total_gpa;
            }

            $total_grade = gpa($total_gpa);
            if(empty($old_merit)) {
                $merit = Merit::create(['student_id' => $request['student_id'],'student_id' => Student::find($request['student_id'])->roll,'sclass_id' => $request['sclass_id'],'exam_id' => $request['exam_id'],'section_id' => $section_id,'group_id' => $group_id,'session' => $request['session'],'total_mark' => $total_mark,'fail_subjects' => 0,'gpa' => $total_gpa,'grade' => $total_grade,'pass' => 1,'fail' => 0,'is_golden' => $is_golden,'wo_gpa' => $without_optional_gpa]);
            } else {
                $merit = Merit::find($old_merit->id);
                $merit->update(['student_id' => $request['student_id'],'student_id' => Student::find($request['student_id'])->roll,'sclass_id' => $request['sclass_id'],'exam_id' => $request['exam_id'],'section_id' => $section_id,'group_id' => $group_id,'session' => $request['session'],'total_mark' => $total_mark,'fail_subjects' => 0,'gpa' => $total_gpa,'grade' => $total_grade,'pass' => 1,'fail' => 0,'is_golden' => $is_golden,'wo_gpa' => $without_optional_gpa]);
            }
        }

        $total_mark = 0;
        $subject_count = 0;
        $total_points = 0;
        $fail = 0;
        $total_gpa = 0;
        $total_grade = 0;
        $part = "";


        $merits = Merit::where('sclass_id',$request['sclass_id'])
            ->where('exam_id',$request['exam_id'])
            ->where('group_id',$request['group_id'])
            ->where('section_id',$request['section_id'])
            ->where('session',$request['session'])
            ->where('pass',1)
            ->orderBy('gpa','desc')
            ->orderBy('total_mark','desc')
            ->orderBy('student_id','asc')
            ->get();

        $count = 0;
        foreach($merits as $merit) {
            $count++;
            $merit->update(['position' => $count]);
//            if($request['promotion'] == 1) {
//                $std = Student::find($merit->student_id);
//                $std->update(['sclass_id' => $std->sclass_id+1,'roll' => $count]);
//            }
        }

        $demerits = Merit::where('sclass_id',$request['sclass_id'])
            ->where('exam_id',$request['exam_id'])
            ->where('session',$request['session'])
            ->where('group_id',$request['group_id'])
            ->where('section_id',$request['section_id'])
            ->where('fail',1)
            ->orderBy('fail_subjects','asc')
            ->orderBy('total_mark','desc')
            ->orderBy('student_id','asc')
            ->get();

        foreach($demerits as $demerit) {
            $count++;
            $demerit->update(['position' => $count]);
//            if($request['promotion'] == 1) {
//                $std = Student::find($demerit->student_id);
//                $std->update(['sclass_id' => $std->sclass_id+1,'roll' => $count]);
//            }
        }
    }
    
    public function viewMergeResult()
    {
        return view('admin.result.view_merge_result');
    }

    public function getMergeResult(Request $request)
    {
        $class_id = $request['sclass_id'];
        $exam_id = $request['exam_id'];
        $session = $request['session'];
        $section_id = $request['section_id'];
        $group_id = $request['group_id'];

        $subjects = Result::select(DB::raw('distinct subject_id'))
            ->where('student_id',$request['student_id'])
            ->where('sclass_id',$request['sclass_id'])
            ->where('group_id',$request['group_id'])
            ->get();

        $student_info = Result::where('sclass_id',$request['sclass_id'])
            ->where('section_id',$request['section_id'])
            ->where('group_id',$request['group_id'])
            ->where('session',$request['session'])
            ->where('exam_id',$request['exam_id'])
            ->first();

        $student = Student::find($student_info->student_id);
//        return $student;



        return view('admin.result.get_merge_result',compact('subjects','grade','student','class_id','exam_id','session','section_id','group_id'));
    }
    
    public function getSms()
    {
        return view('admin.result.get_sms');
    }

    public function getSmsInfo(Request $request)
    {
        $class_id = $request['sclass_id'];
        $exam_id = $request['exam_id'];
        $session = $request['session'];
        $section_id = $request['section_id'];
        $group_id = $request['group_id'];

        if($request['status'] == 1) {
            $results = Merit::where('sclass_id',$request['sclass_id'])
                ->where('session',$request['session'])
                ->where('exam_id',$request['exam_id'])
                ->where('section_id',$request['section_id'])
                ->where('group_id',$request['group_id'])
                ->where('pass',1)
                ->orderBy('position')
                ->get();
            $status = "Passed Students";
        } else if($request['status'] == 2) {
            $results = Merit::where('sclass_id',$request['sclass_id'])
                ->where('session',$request['session'])
                ->where('exam_id',$request['exam_id'])
                ->where('section_id',$request['section_id'])
                ->where('group_id',$request['group_id'])
                ->where('fail',1)
                ->orderBy('position')
                ->get();
            $status = "Failed Students";
        } else {
            $results = Merit::where('sclass_id',$request['sclass_id'])
                ->where('session',$request['session'])
                ->where('exam_id',$request['exam_id'])
                ->where('section_id',$request['section_id'])
                ->where('group_id',$request['group_id'])
                ->orderBy('position')
                ->get();
            $status = "Pass and Failed Students";
        }


        return view('admin.result.send_sms',compact('results','class_id','exam_id','session','section_id','group_id','status'));
    }

    public function sendSms(Request $request)
    {
        $class_id = $request['sclass_id'];
        $exam_id = $request['exam_id'];
        $session = $request['session'];
        $section_id = $request['section_id'];
        $group_id = $request['group_id'];

        foreach($request['students'] as $student) {
            $results[] = Merit::find($student);
        }


        return view('admin.result.final_sms',compact('results','class_id','exam_id','session','section_id','group_id'));
    }
}
