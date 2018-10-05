<?php

namespace App\Http\Controllers;

use App\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SchoolTeacherController extends Controller
{
    public function index()
    {
        $records = Teacher::all();
        return view('admin.Teacher.index',compact('records'));
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
//        return $request->all();
        $teacher = Teacher::find($id);
        $input = $request->all();
        unset($input['password']);
        if(!empty($request['password'])) {
            $input['cpassword'] = $request['password'];
            $input['password'] = Hash::make($request['password']);
        }

        if($file = $request->file('file')) {
            $image = time(). $file->getClientOriginalName();
            $file->move('images',$image);
            $input['image'] = $image;
        }
//        return $input;

//        return public_path()."/images/".$teacher->image;

        if(!empty($teacher->image)) {

            if(file_exists("images/".$teacher->image)) {
                unlink("images/".$teacher->image);
            }
        }
        $teacher->update($input);
        return redirect()->back()->with([
            'success' => 'Teacher Updated Successfully.'
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

}
