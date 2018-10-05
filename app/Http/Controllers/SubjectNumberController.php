<?php

namespace App\Http\Controllers;

use App\SubjectNumber;
use Illuminate\Http\Request;

class SubjectNumberController extends Controller
{
    public function index()
    {
        $records = SubjectNumber::all();
        return view('admin.SubjectNumber.index',compact('records'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'number' => 'required',
            'number' => 'required'
        ]);

        $input = $request->all();
        SubjectNumber::create($input);
        return redirect()->back()->with([
            'success' => 'SubjectNumber Created.'
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'number' => 'required'
        ]);

        $record = SubjectNumber::find($id);
        $record->update($request->all());
        return redirect()->back()->with([
            'success' => 'Record Updated Successfully.'
        ]);
    }

    public function destroy($id)
    {
        $record = SubjectNumber::find($id);
        $record->delete();
        return redirect()->back()->with([
            'success' => 'Record Deleted Successfully.'
        ]);
    }
}