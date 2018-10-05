<?php

namespace App\Http\Controllers;

use App\Link;
use Illuminate\Http\Request;

class LinkController extends Controller
{
    public function index()
    {
        $records = Link::all();
        return view('admin.Link.index',compact('records'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        $input = $request->all();
        Link::create($input);
        return redirect()->back()->with([
            'success' => 'Link Created.'
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        $record = Link::find($id);
        $record->update($request->all());
        return redirect()->back()->with([
            'success' => 'Record Updated Successfully.'
        ]);
    }

    public function destroy($id)
    {
        $record = Link::find($id);
        $record->delete();
        return redirect()->back()->with([
            'success' => 'Record Deleted Successfully.'
        ]);
    }
}
