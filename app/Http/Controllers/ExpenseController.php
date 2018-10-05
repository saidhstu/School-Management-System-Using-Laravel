<?php

namespace App\Http\Controllers;

use App\Expense;
use App\ExpenseHead;
use App\ExpenseSerial;
use App\MainHead;
use App\SubHead;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function index()
    {
        return view('admin.Expense.index');
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'expense_head' => 'required',
            'amount' => 'required',
            'date_of_expense' => 'required'
        ]);

//        $serial = ExpenseSerial::take(1)->orderBy('id','desc')->first();
//
//        if(empty($serial)) {
//            $new_serial = ExpenseSerial::create(['serial' => 1]);
//        } else {
//            $new_serial = ExpenseSerial::create(['serial' => $serial->serial+1]);
//        }



        $expensehead = ExpenseHead::where('name',$request['expense_head'])->first();

        if(empty($expensehead)) {
            $expensehead = ExpenseHead::create(['name' => $request['expense_head']]);
        }

        Expense::create([
            'expense_head_id' => $expensehead->id,
            'amount' => $request['amount'],
            'remarks' => $request['remarks'],
            'date_of_expense' => $request['date_of_expense']
        ]);


        return redirect()->back()->with([
            'success' => 'Expense Created.'
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'amount' => 'required'
        ]);

        $record = Expense::find($id);
        $record->update($request->all());
        return redirect()->back()->with([
            'success' => 'Record Updated Successfully.'
        ]);
    }

    public function destroy($id)
    {
        $record = Expense::find($id);
        $record->delete();
        return redirect()->back()->with([
            'success' => 'Record Deleted Successfully.'
        ]);
    }

    public function expenseReport()
    {
        $from = gmdate('Y-m-d')." 00:00:00";
        $to = gmdate('Y-m-d')." 23:59:59";

        $reports = Expense::whereBetween('created_at',[$from,$to])->get();
        return view('admin.Expense.report',compact('reports'));
    }

    public function collectReport(Request $request)
    {
        $from = $request['from']." 00:00:00";
        $to = $request['to']." 23:59:59";
        $reports = Expense::whereBetween('created_at',[$from,$to])->get();
        return view('admin.Expense.report',compact('reports'));
    }
}