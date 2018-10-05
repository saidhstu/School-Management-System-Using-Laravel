<?php

namespace App\Http\Controllers;

use App\Co;
use Illuminate\Http\Request;

class CoController extends Controller
{
    public function index()
    {
        $records = Co::all();
        return view('admin.Co.index',compact('records'));
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
            $input['file'] = $image;
        }




        Co::create($input);
        return redirect()->back()->with([
            'success' => 'Co Created.'
        ]);
    }

    public function update(Request $request, $id)
    {

        $this->validate($request, [
            'name' => 'required'
        ]);


        $input = $request->all();
//        return $input;
        if($file = $request->file('file')) {
            $image = time(). $file->getClientOriginalName();
            $file->move('website/images',$image);
            $input['file'] = $image;
        } else {
            unset($input['file']);
        }

        $record = Co::find($id);
        if(file_exists(public_path()."/website/images/".$record->file)) {
            unlink(public_path()."/website/images/".$record->file);
        }

        $record->update($input);

        return redirect()->back()->with([
            'success' => 'Record Updated Successfully.'
        ]);

    }


    public function destroy($id)
    {
        $record = Co::find($id);
        if(file_exists(public_path()."/website/images/".$record->image)) {
            unlink(public_path()."/website/images/".$record->image);
        }
        $record->delete();
        return redirect()->back()->with([
            'success' => 'Record Deleted Successfully.'
        ]);
    }
}

