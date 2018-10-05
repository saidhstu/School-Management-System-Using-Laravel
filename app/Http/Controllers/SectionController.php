<?php

namespace App\Http\Controllers;

use App\Section;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    public function index()
    {
        $records = Section::all();
        return view('admin.Section.index',compact('records'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        $input = $request->all();
        Section::create($input);
        return redirect()->back()->with([
            'success' => 'Section Created.'
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        $record = Section::find($id);
        $record->update($request->all());
        return redirect()->back()->with([
            'success' => 'Record Updated Successfully.'
        ]);
    }

    public function destroy($id)
    {
        $record = Section::find($id);
        $record->delete();
        return redirect()->back()->with([
            'success' => 'Record Deleted Successfully.'
        ]);
    }
}