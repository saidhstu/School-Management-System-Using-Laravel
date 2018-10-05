<?php

namespace App\Http\Controllers;

use App\Student;
use App\Tifin;
use Illuminate\Http\Request;

class TifinController extends Controller
{
    public function index()
    {
        $records = Tifin::all();
        return view('admin.Tifin.index',compact('records'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'sclass_id' => 'required',
        ]);

        foreach($request['student_ids'] as $student_id) {
            $student = Student::find($student_id);
            if(!empty($request['indi_amount'][$student_id])) {
                for($i = $request['from']; $i <= $request['to']; $i++) {
                    $month = $i < 10 ? "0".$i : $i;
                    $info = array(
                        "sclass_id" => $request['sclass_id'],
                        "section_id" => $request['section_id'],
                        "group_id" => $request['group_id'],
                        "version_id" => $student->version_id,
                        "staying_id" => $student->staying_id,
                        "month" => $i,
                        "session_month" => $request['session']."/".$month,
                        "session" => $request['session'],
                        "student_id" => $student_id,
                        "amount" => $request['indi_amount'][$student_id]
                    );
                    Tifin::create($info);
                }

            } else {
                for($i = $request['from']; $i <= $request['to']; $i++) {
                    $month = $i < 10 ? "0".$i : $i;
                    $info = array(
                        "sclass_id" => $request['sclass_id'],
                        "section_id" => $request['section_id'],
                        "group_id" => $request['group_id'],
                        "version_id" => $student->version_id,
                        "staying_id" => $student->staying_id,
                        "month" => $i,
                        "session_month" => $request['session']."/".$month,
                        "session" => $request['session'],
                        "student_id" => $student_id,
                        "amount" => $request['amount']
                    );
                    Tifin::create($info);
                }
            }
        }

//        return redirect('Tifin/fees')->with([
//            'success' => 'Fee Asigned Successfully.'
//        ]);

    }

    public function update(Request $request, $id)
    {
//        return $request->all();
        $this->validate($request, [
            'session' => 'required',
            'month' => 'required',
            'amount' => 'required',
        ]);

        $record = Tifin::find($id);
        $student = Student::find($record->student_id);
        $record->update($request->all());
        return redirect()->back()->with([
            'success' => 'Record Updated Successfully.',
            'student' => $student
        ]);
    }

    public function destroy($id)
    {
        $record = Tifin::find($id);
        $student = Student::find($record->student_id);
        $record->delete();
        return redirect()->back()->with([
            'success' => 'Record Deleted Successfully.',
            'student' => $student
        ]);
    }

    public function getStudents(Request $request)
    {
        $students = Student::where('sclass_id',$request['sclass_id'])->where('section_id',$request['section_id'])->where('group_id',$request['group_id'])->where('session',$request['session'])->orderBy('id')->get();
        $sclass_id = $request['sclass_id'];
        $section_id = $request['section_id'];
        $group_id = $request['group_id'];
        $fund_id = $request['fund_id'];
        $session = $request['session'];
        return view('admin.Tifin.index',compact('students','sclass_id','section_id','group_id','session','fund_id'));
    }

    public function feeEdit()
    {
        return view('admin.Tifin.edit');
    }

    public function getStudentsEdit(Request $request)
    {
        $students = Student::where('department_id',$request['department_id'])->where('semester_id',$request['semester_id'])->where('session',$request['session'])->orderBy('stu_id')->get();
        $department = $request['department_id'];
        $semester = $request['semester_id'];
        $session = $request['session'];
        return view('admin.Tifin.edit',compact('students','department','semester','session'));
    }

    public function feeUpdate(Request $request)
    {
        foreach($request['student_ids'] as $student_id) {
            $fee = Tifin::find($student_id);
            $fee->update(['amount' => $request['semester_amount'][$student_id]]);
        }

        return redirect('midterm/edit/fees')->with([
            'success' => 'Fee Updated Successfully.'
        ]);
    }
}