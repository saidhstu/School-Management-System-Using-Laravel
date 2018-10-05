<?php

namespace App\Http\Controllers;

use App\Notice;
use Illuminate\Http\Request;

class NoticeController extends Controller
{
    public function index()
    {
        $records = Notice::all();
        return view('admin.Notice.index',compact('records'));
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

//        return $input['image'];

//        return $input;




        Notice::create($input);
        return redirect()->back()->with([
            'success' => 'Notice Created.'
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

        $record = Notice::find($request->id);
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
        $record = Notice::find($id);
        if(file_exists(public_path()."/website/images/".$record->image)) {
            unlink(public_path()."/website/images/".$record->image);
        }
        $record->delete();
        return redirect()->back()->with([
            'success' => 'Record Deleted Successfully.'
        ]);
    }
}

