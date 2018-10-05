<?php

namespace App\Http\Controllers;

use App\Monthly;
use Illuminate\Http\Request;

class MonthlyController extends Controller
{
    public function index()
    {
        $records = Monthly::all();
        return view('admin.Monthly.index',compact('records'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        $input = $request->all();
        Monthly::create($input);
        return redirect()->back()->with([
            'success' => 'Monthly Created.'
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        $record = Monthly::find($id);
        $record->update($request->all());
        return redirect()->back()->with([
            'success' => 'Record Updated Successfully.'
        ]);
    }

    public function destroy($id)
    {
        $record = Monthly::find($id);
        $record->delete();
        return redirect()->back()->with([
            'success' => 'Record Deleted Successfully.'
        ]);
    }
}