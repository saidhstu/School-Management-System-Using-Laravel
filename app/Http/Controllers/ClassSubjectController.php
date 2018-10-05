<?php

namespace App\Http\Controllers;

use App\ClassSubject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ClassSubjectController extends Controller
{
    public function index()
    {
        return view('admin.ClassSubject.index');
    }

    public function store(Request $request)
    {
//        return $request->all();

        foreach($request['exams'] as $exam) {
            foreach($request['subjects'] as $subject) {
                if(empty($request['total_pass'][$subject])) {
                    $total_pass = 0;
                } else {
                    $total_pass = 1;
                }

                if(empty($request['has_monthly'][$subject])) {
                    $has_monthly = 0;
                } else {
                    $has_monthly = 1;
                }

                if(empty($request['inactive'][$subject])) {
                    $inactive = 0;
                } else {
                    $inactive = 1;
                }

                if(empty($request['single_pass'][$subject])) {
                    $single_pass = 0;
                } else {
                    $single_pass = 1;
                }

                $info = array(
                    'sclass_id' => $request['sclass_id'],
                    'exam_id' => $exam,
                    'group_id' => $request['group_id'],
                    'subject_id' => $subject,
                    'subjective' => $request['subjective'][$subject],
                    'sub_pass' => $request['sub_pass'][$subject],
                    'objective' => $request['objective'][$subject],
                    'obj_pass' => $request['obj_pass'][$subject],
                    'practical' => $request['practical'][$subject],
                    'prac_pass' => $request['prac_pass'][$subject],
                    'percent' => $request['percent'][$subject],
                    'part' => $request['part'][$subject],
                    'rank' => $request['rank'][$subject],
                    'monthly_limit' => $request['monthly_limit'][$subject],
                    'total_pass' => $total_pass,
                    'single_pass' => $single_pass,
                    'inactive' => $inactive,
                    'has_monthly' => $has_monthly,
                );


                ClassSubject::create($info);

            }
        }


        return redirect()->back()->with([
            'success' => 'Record Created.'
        ]);
    }

    public function update(Request $request, $id)
    {

//        return $request->all();
        $this->validate($request, [
            'sclass_id' => 'required',
            'exam_id' => 'required'
        ]);

        if(empty($request['total_pass'])) {
            $request['total_pass'] = 0;
        }

        if(empty($request['has_monthly'])) {
            $request['has_monthly'] = 0;
        }

        if(empty($request['single_pass'])) {
            $request['single_pass'] = 0;
        }

        if(empty($request['inactive'])) {
            $request['inactive'] = 0;
        }

//        return $request->all();
        $record = ClassSubject::find($id);


//        return $records;


        $record->update($request->all());

        if(!empty($record->group_id)) {
            $records = ClassSubject::where('sclass_id',$record->sclass_id)
                ->where('exam_id',$record->exam_id)
                ->where('group_id',$record->group_id)
                ->orderBy('rank')
                ->get();
        } else {
            $records = ClassSubject::where('sclass_id',$record->sclass_id)
                ->where('exam_id',$record->exam_id)
                ->orderBy('rank')
                ->get();
        }
        return redirect('/class/subjects')->with([
            'success' => 'Record Updated Successfully.',
            'records' => $records,
            'class_id' => $request['sclass_id'],
            'exam_id' => $request['exam_id'],
            'group_id' => $request['group_id'],
        ]);
    }

    public function destroy($id)
    {
        $record = ClassSubject::find($id);
        if(!empty($record->group_id)) {
            $records = ClassSubject::where('sclass_id',$record->sclass_id)
                ->where('exam_id',$record->exam_id)
                ->where('group_id',$record->group_id)
                ->orderBy('rank')
                ->get();
        } else {
            $records = ClassSubject::where('sclass_id',$record->sclass_id)
                ->where('exam_id',$record->exam_id)
                ->orderBy('rank')
                ->get();
        }

        $record->delete();
        return redirect('/class/subjects')->with([
            'success' => 'Record Deleted Successfully.',
            'records' => $records
        ]);
    }

    public function getClassSubjects(Request $request)
    {
        $class_id = $request['sclass_id'];
        $group_id = $request['group_id'];
        $exam_id = $request['exam_id'];
        $choose = $request['choose'];

        if(!empty($request['group_id'])) {
            $records = ClassSubject::where('sclass_id',$request['sclass_id'])
                ->where('exam_id',$request['exam_id'])
                ->where('group_id',$request['group_id'])
                ->orderBy('rank')
                ->get();
        } else {
            $records = ClassSubject::where('sclass_id',$request['sclass_id'])
                ->where('exam_id',$request['exam_id'])
                ->orderBy('rank')
                ->get();
        }

        Session::forget('records');
        Session::forget('class_id');
        Session::forget('group_id');
        Session::forget('exam_id');

        return view('admin.ClassSubject.index',compact('records','class_id','group_id','exam_id','choose'));
    }
}