<?php

namespace App\Http\Controllers;

use App\AttendencePayment;
use App\ExamPayment;
use App\FinePayment;
use App\FormPayment;
use App\GetBeton;
use App\GetElec;
use App\GetSessionFee;
use App\GetTifin;
use App\OtherPayment;
use App\ProductPayment;
use App\Serial;
use App\Student;
use Illuminate\Http\Request;

class FeesController extends Controller
{
    public function index()
    {
        return view('admin.Fees.index');
    }

    public function store(Request $request)
    {
//        return $request->all();

        $student = Student::find($request['student_id']);

        $serial = Serial::take(1)->orderBy('id','desc')->first();

        if(empty($serial)) {
            $new_serial = Serial::create([
                'serial' => 1,
                'student_id' => $student->id,
                'sclass_id' => $student->sclass_id,
                'section_id' => $student->section_id,
                "session" => $student->session,
                'group_id' => $student->group_id,
                "version_id" => $student->version_id,
                "staying_id" => $student->staying_id
            ]);
        } else {
            $new_serial = Serial::create([
                'serial' => $serial->serial+1,
                'student_id' => $student->id,
                'sclass_id' => $student->sclass_id,
                'section_id' => $student->section_id,
                "session" => $student->session,
                'group_id' => $student->group_id,
                "version_id" => $student->version_id,
                "staying_id" => $student->staying_id
            ]);
        }


        if(!empty(count($request['beton_class']))) {
            foreach($request['beton_class'] as $key =>  $value) {
                if(!empty($request['beton_amount'][$key]) && !empty($request['beton_session'][$key]) && !empty($request['beton_month'][$key])) {
                    $info = array(
                        'student_id' => $student->id,
                        'sclass_id' => $value,
                        'section_id' => $student->section_id,
                        'group_id' => $student->group_id,
                        "version_id" => $student->version_id,
                        "staying_id" => $student->staying_id,
                        'month' => $request['beton_month'][$key],
                        'session' => $request['beton_session'][$key],
                        'session_month' => date('Y/m'),
                        'amount' => $request['beton_amount'][$key],
                        'serial_id' => $new_serial->id,
                    );
                    GetBeton::create($info);
                }


            }
        }

        if(!empty(count($request['tifin_class']))) {
            foreach($request['tifin_class'] as $key =>  $value) {
                if(!empty($request['tifin_amount'][$key]) && !empty($request['tifin_session'][$key]) && !empty($request['tifin_month'][$key])) {
                    $info = array(
                        'student_id' => $student->id,
                        'sclass_id' => $value,
                        'section_id' => $student->section_id,
                        'group_id' => $student->group_id,
                        "version_id" => $student->version_id,
                        "staying_id" => $student->staying_id,
                        'month' => $request['tifin_month'][$key],
                        'session' => $request['tifin_session'][$key],
                        'session_month' => date('Y/m'),
                        'amount' => $request['tifin_amount'][$key],
                        'serial_id' => $new_serial->id,
                    );
                    GetTifin::create($info);
                }


            }
        }

        if(!empty(count($request['elec_class']))) {
            foreach($request['elec_class'] as $key =>  $value) {
                if(!empty($request['elec_amount'][$key]) && !empty($request['elec_session'][$key]) && !empty($request['elec_month'][$key])) {
                    $info = array(
                        'student_id' => $student->id,
                        'sclass_id' => $value,
                        'section_id' => $student->section_id,
                        'group_id' => $student->group_id,
                        "version_id" => $student->version_id,
                        "staying_id" => $student->staying_id,
                        'month' => $request['elec_month'][$key],
                        'session' => $request['elec_session'][$key],
                        'session_month' => date('Y/m'),
                        'amount' => $request['elec_amount'][$key],
                        'serial_id' => $new_serial->id,
                    );
                    GetElec::create($info);
                }


            }
        }

        if(!empty(count($request['session_class']))) {
            foreach($request['session_class'] as $key =>  $value) {
                if(!empty($request['session_amount'][$key]) && !empty($request['session_session'][$key])) {
                    $info = array(
                        'student_id' => $student->id,
                        'sclass_id' => $value,
                        'section_id' => $student->section_id,
                        'group_id' => $student->group_id,
                        "version_id" => $student->version_id,
                        "staying_id" => $student->staying_id,
                        'session' => $request['session_session'][$key],
                        'session_month' => date('Y/m'),
                        'month' => date('m'),
                        'amount' => $request['session_amount'][$key],
                        'serial_id' => $new_serial->id,
                    );
                    GetSessionFee::create($info);
                }


            }
        }

        if(!empty($request['other_class'])) {
            foreach($request['other_class'] as $key =>  $value) {
                if(!empty($request['other_fund'][$key]) && !empty($request['other_session'][$key]) && $request['other_amount'][$key]) {
                    $info = array(
                        'student_id' => $student->id,
                        'sclass_id' => $value,
                        'section_id' => $student->section_id,
                        'group_id' => $student->group_id,
                        "version_id" => $student->version_id,
                        "staying_id" => $student->staying_id,
                        'fund_id' => $request['other_fund'][$key],
                        'session' => $request['other_session'][$key],
                        'session_month' => date('Y/m'),
                        'month' => date('m'),
                        'amount' => $request['other_amount'][$key],
                        'serial_id' => $new_serial->id,
                    );

                    OtherPayment::create($info);
                }
            }
        }

        if(!empty($request['exam_class'])) {
            foreach($request['exam_class'] as $key =>  $value) {
                if(!empty($request['exam_id'][$key]) && !empty($request['exam_session'][$key]) && !empty($request['exam_amount'][$key])) {
                    $info = array(
                        'student_id' => $student->id,
                        'sclass_id' => $value,
                        'section_id' => $student->section_id,
                        'group_id' => $student->group_id,
                        "version_id" => $student->version_id,
                        "staying_id" => $student->staying_id,
                        'exam_id' => $request['exam_id'][$key],
                        'session' => $request['exam_session'][$key],
                        'session_month' => date('Y/m'),
                        'month' => date('m'),
                        'amount' => $request['exam_amount'][$key],
                        'serial_id' => $new_serial->id,
                    );

                    ExamPayment::create($info);
                }
            }
        }

        if(!empty($request['form_class'])) {
            foreach($request['form_class'] as $key =>  $value) {
                if(!empty($request['form_exam_id'][$key]) && !empty($request['form_session'][$key]) && !empty($request['form_amount'][$key])) {
                    $info = array(
                        'student_id' => $student->id,
                        'sclass_id' => $value,
                        'section_id' => $student->section_id,
                        'group_id' => $student->group_id,
                        "version_id" => $student->version_id,
                        "staying_id" => $student->staying_id,
                        'exam_id' => $request['form_exam_id'][$key],
                        'session' => $request['form_session'][$key],
                        'session_month' => date('Y/m'),
                        'month' => date('m'),
                        'amount' => $request['form_amount'][$key],
                        'serial_id' => $new_serial->id,
                    );

                    FormPayment::create($info);
                }
            }
        }

        if(!empty($request['fine_class'])) {
            foreach($request['fine_class'] as $key =>  $value) {
                if(!empty($request['fine_month'][$key]) && !empty($request['fine_session'][$key]) && !empty($request['fine_amount'][$key])) {
                    $info = array(
                        'student_id' => $student->id,
                        'sclass_id' => $value,
                        'section_id' => $student->section_id,
                        'group_id' => $student->group_id,
                        "version_id" => $student->version_id,
                        "staying_id" => $student->staying_id,
                        'month' => $request['fine_month'][$key],
                        'session' => $request['fine_session'][$key],
                        'session_month' => date('Y/m'),
                        'amount' => $request['fine_amount'][$key],
                        'serial_id' => $new_serial->id,
                    );

                    FinePayment::create($info);
                }
            }
        }

        if(!empty($request['attendence_class'])) {
            foreach($request['attendence_class'] as $key =>  $value) {
                if(!empty($request['attendence_month'][$key]) && !empty($request['attendence_session'][$key]) && !empty($request['attendence_amount'][$key])) {
                    $info = array(
                        'student_id' => $student->id,
                        'sclass_id' => $value,
                        'section_id' => $student->section_id,
                        'group_id' => $student->group_id,
                        "version_id" => $student->version_id,
                        "staying_id" => $student->staying_id,
                        'month' => $request['attendence_month'][$key],
                        'session' => $request['attendence_session'][$key],
                        'session_month' => date('Y/m'),
                        'amount' => $request['attendence_amount'][$key],
                        'serial_id' => $new_serial->id,
                    );

                    AttendencePayment::create($info);
                }
            }
        }

        if(!empty($request['accessory_session'])) {
            foreach($request['accessory_session'] as $key =>  $value) {
                if(!empty($request['accessory_month'][$key]) && !empty($request['accessory_session'][$key]) && !empty($request['accessory_amount'][$key])) {
                    $info = array(
                        'student_id' => $student->id,
                        'sclass_id' => $value,
                        'section_id' => $student->section_id,
                        'group_id' => $student->group_id,
                        'month' => $request['accessory_month'][$key],
                        'session' => $request['accessory_session'][$key],
                        'year' => $request['accessory_session'][$key],
                        'amount' => $request['accessory_amount'][$key],
                        'serial_id' => $new_serial->id,
                    );

                    ProductPayment::create($info);
                }
            }
        }
//        Sms::create(['amount' => 5,'serial_id' => 1]);

        $serial = $new_serial;
        return view('admin.Fees.report',compact('serial'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        $record = Fees::find($id);
        $record->update($request->all());
        return redirect()->back()->with([
            'success' => 'Record Updated Successfully.'
        ]);
    }

    public function destroy($id)
    {
        $record = Fees::find($id);
        $record->delete();
        return redirect()->back()->with([
            'success' => 'Record Deleted Successfully.'
        ]);
    }

    public function getDepartment(Request $request)
    {
        $tech = Department::where('code',$request['code'])->first();
        return view('admin.js_files.search_department',compact('tech'));
    }

    public function getStudentHistory(Request $request)
    {
        $stu_id = $request['student_id'];
        $student = Student::where('id',$stu_id)->first();
        return view('admin.js_files.history',compact('student'));
    }

    public function getStudentImg(Request $request)
    {
        $stu_id = $request['student_id'];
        $student = Student::where('id',$stu_id)->first();
        return view('admin.js_files.image',compact('student'));
    }

    public function getStudentInfo(Request $request)
    {
        $stu_id = $request['student_id'];
        $student = Student::where('id',$stu_id)->first();
        return view('admin.js_files.student_info',compact('student'));
    }

    public function receipt($serial)
    {
        $serial = Serial::find($serial);
        return view('admin.Fees.report',compact('serial'));
    }

    public function viewReceipt(Request $request)
    {
        $get_receipt = Serial::where('serial',$request['serial'])->first();
        $serial = Serial::find($get_receipt->id);
        return view('admin.Fees.view_receipt',compact('serial'));
    }
}