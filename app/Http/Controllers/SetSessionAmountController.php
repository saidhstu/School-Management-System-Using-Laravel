<?php

namespace App\Http\Controllers;

use App\SetSessionAmount;
use Illuminate\Http\Request;

class SetSessionAmountController extends Controller
{
    public function index()
    {
        return view('admin.SetSessionAmount.index');
    }

    public function store(Request $request)
    {
        foreach($request['funds'] as $value) {
            if(!empty($request['amounts'][$value])) {
                SetSessionAmount::create([
                    'fund_id' => $value,
                    'amount' => $request['amounts'][$value],
                    'remarks' => $request['remarks'][$value],
                    'session' => $request['session'],
                    'sclass_id' => $request['sclass_id']
                ]);
            }
        }

        return redirect()->back()->with([
            'success' => 'SetSessionAmount Created.'
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'amount' => 'required'
        ]);

        $record = SetSessionAmount::find($id);
        $record->update($request->all());
        return redirect()->back()->with([
            'success' => 'Record Updated Successfully.'
        ]);
    }

    public function destroy($id)
    {
        $record = SetSessionAmount::find($id);
        $record->delete();
        return redirect()->back()->with([
            'success' => 'Record Deleted Successfully.'
        ]);
    }

    public function SetSessionAmountReport()
    {
        $from = gmdate('Y-m-d')." 00:00:00";
        $to = gmdate('Y-m-d')." 23:59:59";

        $reports = SetSessionAmount::whereBetween('created_at',[$from,$to])->get();
        return view('admin.SetSessionAmount.report',compact('reports'));
    }

    public function collectReport(Request $request)
    {
        $from = $request['from']." 00:00:00";
        $to = $request['to']." 23:59:59";
        $reports = SetSessionAmount::whereBetween('created_at',[$from,$to])->get();
        return view('admin.SetSessionAmount.report',compact('reports'));
    }
}