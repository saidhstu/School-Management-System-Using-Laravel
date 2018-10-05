<?php

namespace App\Http\Controllers;

use App\Exam;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    public function index()
    {
        $records = Exam::all();
        return view('admin.Exam.index',compact('records'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        $input = $request->all();
        Exam::create($input);
        return redirect()->back()->with([
            'success' => 'Exam Created.'
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        $record = Exam::find($id);
        $record->update($request->all());
        return redirect()->back()->with([
            'success' => 'Record Updated Successfully.'
        ]);
    }

    public function destroy($id)
    {
        $record = Exam::find($id);
        $record->delete();
        return redirect()->back()->with([
            'success' => 'Record Deleted Successfully.'
        ]);
    }
}