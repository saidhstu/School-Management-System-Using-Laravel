<?php

namespace App\Http\Controllers;

use App\Gallery;
use Illuminate\Http\Request;

class GalaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = Gallery::all();
        return view('admin.galaries.index',compact('records'));
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
            $input['image'] = $image;
        }



        Gallery::create($input);
        return redirect()->back()->with([
            'success' => 'Gallery Created.'
        ]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $this->validate($request, [
            'title' => 'required'
        ]);

        $input = $request->all();

        if($file = $request->file('image')) {
            $image = time(). $file->getClientOriginalName();
            $file->move('website/images',$image);
            $input['image'] = $image;
        }

        $record = Gallery::find($request->id);
        if(file_exists(public_path()."/website/images/".$record->image)) {
            unlink(public_path()."/website/images/".$record->image);
        }

        $record->update($input);

        return redirect()->back()->with([
            'success' => 'Record Updated Successfully.'
        ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record = Gallery::find($id);
        if(file_exists(public_path()."/website/images/".$record->image)) {
            unlink(public_path()."/website/images/".$record->image);
        }
        $record->delete();
        return redirect()->back()->with([
            'success' => 'Record Deleted Successfully.'
        ]);
    }
}


