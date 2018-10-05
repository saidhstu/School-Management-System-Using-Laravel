<?php

namespace App\Http\Controllers;

use App\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Excel;

class TeacherController extends Controller
{
    public function index()
    {
        return view('Teacher.home');
    }

    public function getAllTeacher()
    {
        $records = Teacher::all();
        return view('admin.Teacher.index',compact('records'));
    }



    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $input = $request->all();
//        return $input;
        $input['cpassword'] = $request['password'];
        $input['password'] = Hash::make($request['password']);
        if($file = $request->file('file')) {
            $image = time(). $file->getClientOriginalName();
            $file->move('images',$image);
            $input['image'] = $image;
        }
        $teacher = Teacher::create($input);
        return redirect()->back()->with([
            'success' => 'Teacher Added Successfully.'
        ]);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $teacher = Teacher::find($id);
        $input = $request->all();
        $input['cpassword'] = $request['password'];
        $input['password'] = Hash::make($request['password']);
        $teacher->update($input);
        return redirect()->back()->with([
            'success' => 'Teacher Added Successfully.'
        ]);
    }

    public function destroy($id)
    {
        //
    }

    public function importTeacher(Request $request)
    {
        $results = Excel::load($request->file('file'),function($reader)
        {
            $reader->all();
        })->get();

        foreach($results as $key => $result) {
            Teacher::create([
                'name' => $result->name,
                'mobile' => $result->mobile,
                'address' => $result->address,
                'email' => $result->email,
                'religion' => $result->religion,
                'joining_date' => $result->joining_date
            ]);
        }
    }

    public function getClasses()
    {
        $teacher = Auth::guard('teacher')->user();
        $records = $teacher->classes;
        return view('Teacher.class.index',compact('records'));
    }

    public function getSubjects()
    {
        $teacher = Auth::guard('teacher')->user();
        $records = $teacher->subjects;
        return view('Teacher.subject.index',compact('records'));
    }
}
