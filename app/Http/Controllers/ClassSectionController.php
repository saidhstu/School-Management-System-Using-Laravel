<?php

namespace App\Http\Controllers;

use App\ClassSection;
use App\Sclass;
use Illuminate\Http\Request;

class ClassSectionController extends Controller
{
    public function index()
    {
        $records = ClassSection::all();
        return view('admin.ClassSection.index',compact('records'));
    }

    public function store(Request $request)
    {
        $class = Sclass::find($request['class_id']);
        foreach($request['sections'] as $section) {
            $class->sections()->create(['section_id' => $section]);
        }
        return redirect()->back()->with([
            'success' => 'Record Created.'
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'sclass_id' => 'required',
            'section_id' => 'required'
        ]);

        $record = ClassSection::find($id);
        $record->update($request->all());
        return redirect()->back()->with([
            'success' => 'Record Updated Successfully.'
        ]);
    }

    public function destroy($id)
    {
        $record = ClassSection::find($id);
        $record->delete();
        return redirect()->back()->with([
            'success' => 'Record Deleted Successfully.'
        ]);
    }
}