<?php

namespace App\Http\Controllers;

use App\ClassMonthly;
use App\Sclass;
use Illuminate\Http\Request;

class ClassMonthlyController extends Controller
{
    public function index()
    {
        $records = ClassMonthly::all();
        return view('admin.ClassMonthly.index',compact('records'));
    }

    public function store(Request $request)
    {
        $class = Sclass::find($request['class_id']);
        foreach($request['monthlies'] as $monthly) {
            $class->monthlies()->create(['monthly_id' => $monthly]);
        }
        return redirect()->back()->with([
            'success' => 'Record Created.'
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'sclass_id' => 'required',
            'monthly_id' => 'required'
        ]);

        $record = ClassMonthly::find($id);
        $record->update($request->all());
        return redirect()->back()->with([
            'success' => 'Record Updated Successfully.'
        ]);
    }

    public function destroy($id)
    {
        $record = ClassMonthly::find($id);
        $record->delete();
        return redirect()->back()->with([
            'success' => 'Record Deleted Successfully.'
        ]);
    }
}