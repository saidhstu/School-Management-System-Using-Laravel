<?php

namespace App\Http\Controllers;

use App\Beton;
use App\ClassSubject;
use App\Exam;
use App\Message;
use App\OtherFee;
use App\SentMessage;
use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

class StudentController extends Controller
{
    public function index()
    {
        return view('admin.Student.index');
    }

    public function home()
    {
        return view('student.home');
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $input['cpassword'] = $request['password'];
        $input['password'] = Hash::make($request['password']);

        if($file = $request->file('picture')) {
            $image = time(). $file->getClientOriginalName();
            $file->move('images',$image);
            $input['image'] = $image;
        }
        $student = Student::create($input);

        if(!empty($request['from']) && !empty($request['to'])) {
            for($i = $request['from']; $i <= $request['to']; $i++){
                $month = $i < 10 ? "0".$i : $i;
                $info = array(
                    'student_id' => $student->id,
                    'sclass_id' => $student->sclass_id,
                    'section_id' => $student->section_id,
                    'group_id' => $student->group_id,
                    "version_id" => $student->version_id,
                    "staying_id" => $student->staying_id,
                    'session' => $student->session,
                    "session_month" => $request['session']."/".$month,
                    'session_month' => date('Y/m'),
                    'month' => $i,
                    'amount' => $request['amount']
                );
                Beton::create($info);
            }
        }

        if(!empty($request['fund_ids'])) {
            foreach($request['fund_ids'] as $key => $fund) {
                $info = array(
                    'student_id' => $student->id,
                    'sclass_id' => $student->sclass_id,
                    'section_id' => $student->section_id,
                    'group_id' => $student->group_id,
                    "version_id" => $student->version_id,
                    "staying_id" => $student->staying_id,
                    'session' => $student->session,
                    'session_month' => date('Y/m'),
                    'fund_id' => $fund,
                    'amount' => $request['fund_amounts'][$key],
                    'discount' => $request['discount_amounts'][$key]
                );

                OtherFee::create($info);

            }
        }

        return redirect()->back()->with([
            'success' => 'Student Added Successfully.'
        ]);
    }

    public function get_edit_student($id)
    {
        $record = Student::find($id);
        return view('admin.Student.edit_student',compact('record'));
    }

    public function update(Request $request, $id)
    {
        $student = Student::find($id);
        $input = $request->all();
        if(!empty($request['password'])) {
            $input['cpassword'] = $request['password'];
            $input['password'] = Hash::make($request['password']);
        }
        if($file = $request->file('image')) {
            $image = time(). $file->getClientOriginalName();
            $file->move('images',$image);
            $input['image'] = $image;
        }

        if(!empty($student->image)) {
            if(file_exists("images/".$student->image)) {
                unlink("images/".$student->image);
            }
        }
        $student->update($input);
        return redirect()->back()->with([
            'success' => 'Student Added Successfully.'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student = Student::find($id);
        $student->delete();
        return redirect('/students')->with([
            'success' => 'Student Deleted Successfully.'
        ]);
    }

    public function importStudent(Request $request)
    {
        $results = Excel::load($request->file('file'),function($reader)
        {
            $reader->all();
        })->get();

        foreach($results as $key => $result) {
            Student::create([
                'name' => $result->std_name,
                'roll' => $result->roll,
                'father' => $result->father_name,
                'mother' => $result->mother_name,
                'sclass_id' => $result->class,
                'section_id' => $result->section,
                'group_id' => $result->group,
                'session' => $result->session,
                'mobile' => "0".$result->mobile,
                'gender' => $result->gender,
                'address' => $result->address,
                'email' => $result->email,
                'religion' => $result->religion,
                'birth_date' => $result->birth,
                'nationality' => $result->nationality
            ]);
        }
    }

    public function admission()
    {
        return view('admin.Student.admission');
    }

    public function studentPayments()
    {
        return view('admin.Student.student_payment');
    }

    public function studentPaymentHistory(Request $request)
    {
        $student = Student::find($request['id']);
        return view('admin.js_files.student_payment_history',compact('student'));
    }

    public function getPaymentDetails()
    {
        return view('admin.Student.student_payment_details');
    }

    public function studentPaymentDetails(Request $request)
    {
        $student = Student::find($request['id']);
        return view('admin.js_files.student_payment_details',compact('student'));
    }

    public function getStudents(Request $request)
    {
//        return $request->all();
        $records = Student::where('sclass_id',$request['sclass_id'])
            ->where('session',$request['session'])
            ->where('section_id',$request['section_id'])
            ->where('group_id',$request['group_id'])
            ->orderBy('id','asc')
            ->get();
//        return $students;
        return view('admin.Student.index',compact('records'));
    }

   public function getAdmitCart()
   {
       return view('admin.Student.admit');
   }

    public function getSingleAdmit()
    {
        return view('admin.Student.single_admit');
    }

    public function viewAdmitCart(Request $request)
    {
        if(empty($request['section_id'])) {
            $request['section_id'] = null;
        }

        if(empty($request['group_id'])) {
            $request['group_id'] = null;
        }

        $subjects = ClassSubject::where('sclass_id',$request['sclass_id'])
            ->where('exam_id',$request['exam_id'])
            ->where('group_id',$request['group_id'])
            ->get();

        $students = Student::where('sclass_id',$request['sclass_id'])
            ->where('section_id',$request['section_id'])
            ->where('group_id',$request['group_id'])
            ->where('session',$request['session'])
            ->get();

        $exam = Exam::find($request['exam_id']);
        $session = $request['session'];
        $section_id = $request['section_id'];
        $group_id = $request['group_id'];
        return view('admin.Student.admit',compact('students','exam','session','subjects','section_id','group_id'));
    }

    public function viewSingleAdmit(Request $request)
    {
        if(empty($request['section_id'])) {
            $request['section_id'] = null;
        }

        if(empty($request['group_id'])) {
            $request['group_id'] = null;
        }

        $subjects = ClassSubject::where('sclass_id',$request['sclass_id'])
            ->where('exam_id',$request['exam_id'])
            ->where('group_id',$request['group_id'])
            ->get();

        $student = Student::where('sclass_id',$request['sclass_id'])
            ->where('section_id',$request['section_id'])
            ->where('group_id',$request['group_id'])
            ->where('session',$request['session'])
            ->where('roll',$request['student_roll'])
            ->first();
        $section_id = $request['section_id'];
        $group_id = $request['group_id'];
        $exam = Exam::find($request['exam_id']);
        $session = $request['session'];
        return view('admin.Student.single_admit',compact('student','exam','session','subjects','section_id','group_id'));
    }

    public function sitPlan()
    {
        return view('admin.Student.sit_plan');
    }

    public function getSitPlan(Request $request)
    {
        if(empty($request['section_id'])) {
            $request['section_id'] = null;
        }

        if(empty($request['group_id'])) {
            $request['group_id'] = null;
        }

        $students = Student::where('sclass_id',$request['sclass_id'])
            ->where('section_id',$request['section_id'])
            ->where('group_id',$request['group_id'])
            ->where('session',$request['session'])
            ->get();
        $exam = Exam::find($request['exam_id']);
        $session = $request['session'];
        return view('admin.Student.sit_plan',compact('students','exam','session'));
    }
    public function getDues()
    {
        $student = Auth::guard('student')->user();
        return view('Student.due_info',compact('student'));
    }

    public function getPayments()
    {
        $student = Auth::guard('student')->user();
        return view('Student.payment_info',compact('student'));
    }

    public function getMessages()
    {
        $messages = SentMessage::where('student_id',Auth::guard('student')->user()->id)->orderBy('id','desc')->get();
        return view('Student.messages',compact('messages'));
    }

    public function getSingleMessage($id)
    {
        $message = SentMessage::find($id);
        $message->update(['is_read' => null]);
        return view('Student.single_message',compact('message'));
    }
}
