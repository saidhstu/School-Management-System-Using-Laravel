<?php

namespace App\Http\Controllers;

use App\ExpenseHead;
use Illuminate\Http\Request;

class ExpenseHeadController extends Controller
{
    public function index()
    {
        $records = ExpenseHead::all();
        return view('admin.ExpenseHead.index',compact('records'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        $input = $request->all();
        ExpenseHead::create($input);
        return redirect()->back()->with([
            'success' => 'ExpenseHead Created.'
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        $record = ExpenseHead::find($id);
        $record->update($request->all());
        return redirect()->back()->with([
            'success' => 'Record Updated Successfully.'
        ]);
    }

    public function destroy($id)
    {
        $record = ExpenseHead::find($id);
        $record->delete();
        return redirect()->back()->with([
            'success' => 'Record Deleted Successfully.'
        ]);
    }

    public function searchHead(Request $request)
    {
        $heads = ExpenseHead::where('name','LIKE','%'.$request->term.'%')->get();
        foreach($heads as $head) {
            $expense_heads[] = $head->name;
        }
        return $expense_heads;
    }
}