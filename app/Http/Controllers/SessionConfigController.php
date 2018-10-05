<?php

namespace App\Http\Controllers;

use App\SessionConfig;
use Illuminate\Http\Request;

class SessionConfigController extends Controller
{
    public function index()
    {
        $records = SessionConfig::all();
        return view('admin.SessionConfig.index',compact('records'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        $input = $request->all();
        SessionConfig::create($input);
        return redirect()->back()->with([
            'success' => 'SessionConfig Created.'
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        $record = SessionConfig::find($id);
        $record->update($request->all());
        return redirect()->back()->with([
            'success' => 'Record Updated Successfully.'
        ]);
    }

    public function destroy($id)
    {
        $record = SessionConfig::find($id);
        $record->delete();
        return redirect()->back()->with([
            'success' => 'Record Deleted Successfully.'
        ]);
    }
}