<?php

namespace App\Http\Controllers;

use App\IncomeHead;
use Illuminate\Http\Request;

class IncomeHeadController extends Controller
{
    public function index()
    {
        $records = IncomeHead::all();
        return view('admin.IncomeHead.index',compact('records'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        $input = $request->all();
        IncomeHead::create($input);
        return redirect()->back()->with([
            'success' => 'IncomeHead Created.'
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        $record = IncomeHead::find($id);
        $record->update($request->all());
        return redirect()->back()->with([
            'success' => 'Record Updated Successfully.'
        ]);
    }

    public function destroy($id)
    {
        $record = IncomeHead::find($id);
        $record->delete();
        return redirect()->back()->with([
            'success' => 'Record Deleted Successfully.'
        ]);
    }

    public function searchHead(Request $request)
    {
        $heads = IncomeHead::where('name','LIKE','%'.$request->term.'%')->get();
        foreach($heads as $head) {
            $expense_heads[] = $head->name;
        }
        return $expense_heads;
    }
}