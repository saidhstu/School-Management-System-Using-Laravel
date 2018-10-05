<?php

namespace App\Http\Controllers;

use App\Syllebus;
use Illuminate\Http\Request;

class SyllebusController extends Controller
{
    public function index()
    {
        $records = Syllebus::all();
        return view('admin.Syllebus.index',compact('records'));
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




        Syllebus::create($input);
        return redirect()->back()->with([
            'success' => 'Syllebus Created.'
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

        $record = Syllebus::find($request->id);
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
        $record = Syllebus::find($id);
        if(file_exists(public_path()."/website/images/".$record->image)) {
            unlink(public_path()."/website/images/".$record->image);
        }
        $record->delete();
        return redirect()->back()->with([
            'success' => 'Record Deleted Successfully.'
        ]);
    }
}