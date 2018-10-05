<?php

namespace App\Http\Controllers;

use App\ExtraIncome;
use App\IncomeHead;
use Illuminate\Http\Request;

class ExtraIncomeController extends Controller
{
    public function index()
    {
        return view('admin.ExtraIncome.index');
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'income_head' => 'required',
            'amount' => 'required',
            'date_of_income' => 'required'
        ]);

//        $serial = ExtraIncomeSerial::take(1)->orderBy('id','desc')->first();
//
//        if(empty($serial)) {
//            $new_serial = ExtraIncomeSerial::create(['serial' => 1]);
//        } else {
//            $new_serial = ExtraIncomeSerial::create(['serial' => $serial->serial+1]);
//        }



        $income_head = IncomeHead::where('name',$request['income_head'])->first();

        if(empty($ExtraIncomehead)) {
            $income_head = IncomeHead::create(['name' => $request['income_head']]);
        }

        ExtraIncome::create([
            'income_head_id' => $income_head->id,
            'amount' => $request['amount'],
            'remarks' => $request['remarks'],
            'date_of_income' => $request['date_of_income']
        ]);


        return redirect()->back()->with([
            'success' => 'ExtraIncome Created.'
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'amount' => 'required'
        ]);

        $record = ExtraIncome::find($id);
        $record->update($request->all());
        return redirect()->back()->with([
            'success' => 'Record Updated Successfully.'
        ]);
    }

    public function destroy($id)
    {
        $record = ExtraIncome::find($id);
        $record->delete();
        return redirect()->back()->with([
            'success' => 'Record Deleted Successfully.'
        ]);
    }

    public function incomeReport()
    {
        $from = gmdate('Y-m-d')." 00:00:00";
        $to = gmdate('Y-m-d')." 23:59:59";

        $reports = ExtraIncome::whereBetween('created_at',[$from,$to])->get();
        return view('admin.ExtraIncome.report',compact('reports'));
    }

    public function collectReport(Request $request)
    {
        $from = $request['from']." 00:00:00";
        $to = $request['to']." 23:59:59";
        $reports = ExtraIncome::whereBetween('created_at',[$from,$to])->get();
        return view('admin.ExtraIncome.report',compact('reports'));
    }
}