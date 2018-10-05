<?php

namespace App\Http\Controllers;

use App\Sclass;
use Illuminate\Http\Request;

class SclassController extends Controller
{
    public function index()
    {
        $records = Sclass::all();
        return view('admin.Sclass.index',compact('records'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        $input = $request->all();
        Sclass::create($input);
        return redirect()->back()->with([
            'success' => 'Sclass Created.'
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        $record = Sclass::find($id);
        $record->update($request->all());
        return redirect()->back()->with([
            'success' => 'Record Updated Successfully.'
        ]);
    }

    public function destroy($id)
    {
        $record = Sclass::find($id);
        $record->delete();
        return redirect()->back()->with([
            'success' => 'Record Deleted Successfully.'
        ]);
    }
}
