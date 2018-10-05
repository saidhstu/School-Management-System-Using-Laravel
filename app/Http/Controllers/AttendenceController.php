<?php

namespace App\Http\Controllers;

use App\Attendence;
use App\Student;
use Illuminate\Http\Request;
use Psy\VarDumper\Presenter;

class AttendenceController extends Controller
{

    public function index()
    {
        $records = FormFee::all();
        return view('admin.FormFee.index',compact('records'));
    }

    public function takeAttendence()
    {
        return view('Teacher.Attendence.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'sclass_id' => 'required',
        ]);

            foreach($request['total_ids'] as $student_id) {
                $student = Student::find($student_id);
                $present = \App\Attendence::where('sclass_id',$request['sclass_id'])
                    ->where('attendence_date',$request['attendence_date'])
                    ->where('student_id',$student->id)
                    ->first();

                if(!empty($present)) {
                    $check = Attendence::find($present->id);
                    $check->delete();
                }


                if(in_array($student_id, $request['student_ids'])) {
                    $info = array(
                        "sclass_id" => $request['sclass_id'],
                        "student_roll" => $student->roll,
                        "section_id" => $request['section_id'],
                        "group_id" => $request['group_id'],
                        "version_id" => $student->version_id,
                        "staying_id" => $student->staying_id,
                        "session" => $request['session'],
                        "student_id" => $student_id,
                        "status" => "1",
                        "attendence_date" => $request['attendence_date']

                    );
                } else {
                    $info = array(
                        "sclass_id" => $request['sclass_id'],
                        "student_roll" => $student->roll,
                        "section_id" => $request['section_id'],
                        "group_id" => $request['group_id'],
                        "version_id" => $student->version_id,
                        "staying_id" => $student->staying_id,
                        "session" => $request['session'],
                        "student_id" => $student_id,
                        "status" => 0,
                        "attendence_date" => $request['attendence_date']

                    );
                }

                Attendence::create($info);

            }




//        return redirect('take/attendence')->with([
//            'success' => 'Attenence Taken Successfully.'
//        ]);

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
        $session = $request['session'];
        $date  = $request['attendence_date'];

        return view('Teacher.Attendence.create',compact('students','sclass_id','section_id','group_id','session','date'));
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

    public function viewAttendence()
    {
        return view('Teacher.Attendence.view_attendence');
    }

    public function viewAttendenceReport(Request $request)
    {
        $reports = Attendence::where('sclass_id',$request['sclass_id'])
            ->where('section_id',$request['section_id'])
            ->where('group_id',$request['group_id'])
            ->where('session',$request['session'])
            ->where('attendence_date',$request['attendence_date'])
            ->get();

        $sclass_id = $request['sclass_id'];
        $section_id = $request['section_id'];
        $group_id = $request['group_id'];
        $session = $request['session'];
        $month  = $request['month'];
        return view('Teacher.Attendence.create',compact('students','sclass_id','section_id','group_id','session','month'));
    }
}