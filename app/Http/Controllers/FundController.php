<?php

namespace App\Http\Controllers;

use App\Fund;
use Illuminate\Http\Request;

class FundController extends Controller
{
    public function index()
    {
        $records = Fund::all();
        return view('admin.Fund.index',compact('records'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        $input = $request->all();
        Fund::create($input);
        return redirect()->back()->with([
            'success' => 'Fund Created.'
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        $record = Fund::find($id);
        $record->update($request->all());
        return redirect()->back()->with([
            'success' => 'Record Updated Successfully.'
        ]);
    }

    public function destroy($id)
    {
        $record = Fund::find($id);
        $record->delete();
        return redirect()->back()->with([
            'success' => 'Record Deleted Successfully.'
        ]);
    }
}