<?php

namespace App\Http\Controllers;

use App\AboutMenu;
use Illuminate\Http\Request;

class AboutMenuController extends Controller
{
    public function index()
    {
        $records = AboutMenu::all();
        return view('admin.AboutMenu.index',compact('records'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        $input = $request->all();
        AboutMenu::create($input);
        return redirect()->back()->with([
            'success' => 'AboutMenu Created.'
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        $record = AboutMenu::find($id);
        $record->update($request->all());
        return redirect()->back()->with([
            'success' => 'Record Updated Successfully.'
        ]);
    }

    public function destroy($id)
    {
        $record = AboutMenu::find($id);
        $record->delete();
        return redirect()->back()->with([
            'success' => 'Record Deleted Successfully.'
        ]);
    }
}