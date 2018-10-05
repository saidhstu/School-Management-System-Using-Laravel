<?php

namespace App\Http\Controllers;

use App\FormFee;
use App\Student;
use Illuminate\Http\Request;

class FormFeeController extends Controller
{
    public function index()
    {
        $records = FormFee::all();
        return view('admin.FormFee.index',compact('records'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'sclass_id' => 'required',
        ]);

        foreach($request['student_ids'] as $student_id) {
            $student = Student::find($student_id);
            if(!empty($request['indi_amount'][$student_id])) {
                $info = array(
                    "sclass_id" => $request['sclass_id'],
                    "section_id" => $request['section_id'],
                    "group_id" => $request['group_id'],
                    "version_id" => $student->version_id,
                    "staying_id" => $student->staying_id,
                    "exam_id" => $request['exam_id'],
                    "session" => $request['session'],
                    "session_month" => date("Y/m"),
                    "student_id" => $student_id,
                    "amount" => $request['indi_amount'][$student_id]
                );
                FormFee::create($info);
            } else {
                $info = array(
                    "sclass_id" => $request['sclass_id'],
                    "section_id" => $request['section_id'],
                    "group_id" => $request['group_id'],
                    "version_id" => $student->version_id,
                    "staying_id" => $student->staying_id,
                    "exam_id" => $request['exam_id'],
                    "session" => $request['session'],
                    "session_month" => date("Y/m"),
                    "student_id" => $student_id,
                    "amount" => $request['amount']
                );
                FormFee::create($info);
            }
        }

        return redirect('form/fees')->with([
            'success' => 'Fee Asigned Successfully.'
        ]);

    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'amount' => 'required'
        ]);

        $record = FormFee::find($id);
        $student = Student::find($record->student_id);
        $record->update($request->all());
        return redirect()->back()->with([
            'success' => 'Record Updated Successfully.',
            'student' => $student
        ]);
    }

    public function destroy($id)
    {
        $record = FormFee::find($id);
        $student = Student::find($record->student_id);
        $record->delete();
        return redirect()->back()->with([
            'success' => 'Record Deleted Successfully.',
            'student' => $student
        ]);
    }

    public function getStudents(Request $request)
    {
        if(empty($request['section_id'])) {
            $request['section_id'] = null;
        }
        if(empty($request['group_id'])) {
            $request['group_id'] = null;
        }
        $students = Student::where('sclass_id',$request['sclass_id'])->where('section_id',$request['section_id'])->where('group_id',$request['group_id'])->where('session',$request['session'])->orderBy('id')->get();
        $sclass_id = $request['sclass_id'];
        $section_id = $request['section_id'];
        $group_id = $request['group_id'];
        $exam_id = $request['exam_id'];
        $session = $request['session'];
        return view('admin.FormFee.index',compact('students','sclass_id','section_id','group_id','session','exam_id'));
    }

    public function feeEdit()
    {
        return view('admin.FormFee.edit');
    }

    public function getStudentsEdit(Request $request)
    {
        $students = Student::where('department_id',$request['department_id'])->where('semester_id',$request['semester_id'])->where('session',$request['session'])->orderBy('stu_id')->get();
        $department = $request['department_id'];
        $semester = $request['semester_id'];
        $session = $request['session'];
        return view('admin.FormFee.edit',compact('students','department','semester','session'));
    }

    public function feeUpdate(Request $request)
    {
        foreach($request['student_ids'] as $student_id) {
            $fee = FormFee::find($student_id);
            $fee->update(['amount' => $request['semester_amount'][$student_id]]);
        }

        return redirect('midterm/edit/fees')->with([
            'success' => 'Fee Updated Successfully.'
        ]);;
    }
}