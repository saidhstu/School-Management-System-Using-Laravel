<?php

namespace App\Http\Controllers;

use App\Sclass;
use App\Student;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function dailyReport()
    {
        return view('admin.Report.daily_report');
    }

    public function getPreviousReport(Request $request)
    {
        $date = $request['date'];
        return view('admin.Report.previous_report',compact('date'));
    }

    public function monthlyReport()
    {
        return view('admin.Report.monthly_report');
    }

    public function getMonthlyReport(Request $request)
    {
        $session = $request['session'];
        $month = $request['month'];
        $classes = Sclass::all();
        return view('admin.Report.monthly_report',compact('session','month','classes'));
    }

    public function yearlyReport()
    {
        return view('admin.Report.yearly_report');
    }

    public function getYearlyReport(Request $request)
    {
        return view('admin.Report.monthly_report');
    }

    public function studentReport()
    {
        return view('admin.Report.student_wise_report');
    }

    public function getStudentReport(Request $request)
    {
        $sclass_id = $request['sclass_id'];
        $session = $request['session'];
        $group_id = $request['group_id'];
        $month = $request['month'];
        $section_id = $request['section_id'];
        $students = Student::where('sclass_id',$request['sclass_id'])
            ->where('section_id',$request['section_id'])
            ->where('group_id',$request['group_id'])
            ->where('session',$request['session'])
            ->orderBy('id')
            ->get();
        return view('admin.Report.student_wise_report',compact('students','sclass_id','session','group_id','section_id','month'));
    }
}
