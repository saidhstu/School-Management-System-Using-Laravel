<?php

namespace App\Http\Controllers;

use App\InsInfo;
use Illuminate\Http\Request;

class InsInfoController extends Controller
{
    public function index()
    {
        $records = InsInfo::all();
        return view('admin.InsInfo.index',compact('records'));
    }


    public function store(Request $request)
    {

        $this->validate($request, [
            'name_english' => 'required'
        ]);

        $input = $request->all();
        if($file = $request->file('file')) {
            $image = time(). $file->getClientOriginalName();
            $file->move('website/images',$image);
            $input['file'] = $image;
        }



        InsInfo::create($input);
        return redirect()->back()->with([
            'success' => 'InsInfo Created.'
        ]);
    }

    public function update(Request $request,$id)
    {

        $this->validate($request, [
            'name_english' => 'required'
        ]);

        $input = $request->all();

//        return $input;

        if($file = $request->file('file')) {
            $image = time(). $file->getClientOriginalName();
            $file->move('website/images',$image);
            $input['file'] = $image;
        }

//        return $input;


        $record = InsInfo::find($id);

        if(file_exists("/website/images/".$record->file)) {
            unlink("/website/images/".$record->file);
        }

        $record->update($input);

        return redirect()->back()->with([
            'success' => 'Record Updated Successfully.'
        ]);

    }

    public function destroy($id)
    {
        $record = InsInfo::find($id);
        if(file_exists("/website/images/".$record->file)) {
            unlink("/website/images/".$record->file);
        }
        $record->delete();
        return redirect()->back()->with([
            'success' => 'Record Deleted Successfully.'
        ]);
    }
}