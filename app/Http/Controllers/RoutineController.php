<?php

namespace App\Http\Controllers;

use App\Routine;
use Illuminate\Http\Request;

class RoutineController extends Controller
{
    public function index()
    {
        $records = Routine::all();
        return view('admin.Routine.index',compact('records'));
    }


    public function store(Request $request)
    {

        $this->validate($request, [
            'name' => 'required'
        ]);

        $input = $request->all();
        if($file = $request->file('file')) {
            $image = time(). $file->getClientOriginalName();
            $file->move('website/images',$image);
            $input['image'] = $image;
        }




        Routine::create($input);
        return redirect()->back()->with([
            'success' => 'Routine Created.'
        ]);
    }

    public function update(Request $request)
    {

        $this->validate($request, [
            'name' => 'required'
        ]);


        $input = $request->all();
//        return $input;
        if($file = $request->file('file')) {
            $image = time(). $file->getClientOriginalName();
            $file->move('website/images',$image);
            $input['image'] = $image;
        } else {
            unset($input['image']);
        }

        $record = Routine::find($request->id);
        if(file_exists(public_path()."/website/images/".$record->image)) {
            unlink(public_path()."/website/images/".$record->image);
        }

        $record->update($input);

        return redirect()->back()->with([
            'success' => 'Record Updated Successfully.'
        ]);

    }


    public function destroy($id)
    {
        $record = Routine::find($id);
        if(file_exists(public_path()."/website/images/".$record->image)) {
            unlink(public_path()."/website/images/".$record->image);
        }
        $record->delete();
        return redirect()->back()->with([
            'success' => 'Record Deleted Successfully.'
        ]);
    }
}