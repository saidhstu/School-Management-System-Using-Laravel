<?php

namespace App\Http\Controllers;

use App\AboutDetails;
use Illuminate\Http\Request;

class AboutDetailsController extends Controller
{
    public function index()
    {
        $records = AboutDetails::all();
        return view('admin.AboutDetails.index',compact('records'));
    }


    public function store(Request $request)
    {

        $this->validate($request, [
            'title' => 'required'
        ]);

        $input = $request->all();
        if($file = $request->file('picture')) {
            $image = time(). $file->getClientOriginalName();
            $file->move('website/images',$image);
            $input['file'] = $image;
        }



        AboutDetails::create($input);
        return redirect()->back()->with([
            'success' => 'AboutDetails Created.'
        ]);
    }

    public function update(Request $request)
    {

        $this->validate($request, [
            'title' => 'required'
        ]);

        $input = $request->all();

        if($file = $request->file('picture')) {
            $image = time(). $file->getClientOriginalName();
            $file->move('website/images',$image);
            $input['file'] = $image;
        }

        $record = AboutDetails::find($request->id);
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
        $record = AboutDetails::find($id);
        if(file_exists(public_path()."/website/images/".$record->image)) {
            unlink(public_path()."/website/images/".$record->image);
        }
        $record->delete();
        return redirect()->back()->with([
            'success' => 'Record Deleted Successfully.'
        ]);
    }
}


