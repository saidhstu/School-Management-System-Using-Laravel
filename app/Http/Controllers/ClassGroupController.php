<?php

namespace App\Http\Controllers;

use App\ClassGroup;
use App\Sclass;
use Illuminate\Http\Request;

class ClassGroupController extends Controller
{
    public function index()
    {
        $records = ClassGroup::all();
        return view('admin.ClassGroup.index',compact('records'));
    }

    public function store(Request $request)
    {
        $class = Sclass::find($request['class_id']);
        foreach($request['groups'] as $group) {
            $class->groups()->create(['group_id' => $group]);
        }
        return redirect()->back()->with([
            'success' => 'Record Created.'
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'sclass_id' => 'required',
            'group_id' => 'required'
        ]);

        $record = ClassGroup::find($id);
        $record->update($request->all());
        return redirect()->back()->with([
            'success' => 'Record Updated Successfully.'
        ]);
    }

    public function destroy($id)
    {
        $record = ClassGroup::find($id);
        $record->delete();
        return redirect()->back()->with([
            'success' => 'Record Deleted Successfully.'
        ]);
    }
}