<?php

namespace App\Http\Controllers;

use App\Group;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function index()
    {
        $records = Group::all();
        return view('admin.Group.index',compact('records'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        $input = $request->all();
        Group::create($input);
        return redirect()->back()->with([
            'success' => 'Group Created.'
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        $record = Group::find($id);
        $record->update($request->all());
        return redirect()->back()->with([
            'success' => 'Record Updated Successfully.'
        ]);
    }

    public function destroy($id)
    {
        $record = Group::find($id);
        $record->delete();
        return redirect()->back()->with([
            'success' => 'Record Deleted Successfully.'
        ]);
    }
}