<?php

namespace App\Http\Controllers;

use App\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function index()
    {
        $records = Slider::all();
        return view('admin.Slider.index',compact('records'));
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



        Slider::create($input);
        return redirect()->back()->with([
            'success' => 'Slider Created.'
        ]);
    }

    public function update(Request $request,$id)
    {

        $this->validate($request, [
            'name' => 'required'
        ]);

        $input = $request->all();

        if($file = $request->file('file')) {
            $image = time(). $file->getClientOriginalName();
            $file->move('website/images',$image);
            $input['file'] = $image;
        } else {
            unset($input['file']);
        }

//        return $input;


        $record = Slider::find($id);
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
        $record = Slider::find($id);
        if(file_exists(public_path()."/website/images/".$record->file)) {
            unlink(public_path()."/website/images/".$record->file);
        }
        $record->delete();
        return redirect()->back()->with([
            'success' => 'Record Deleted Successfully.'
        ]);
    }
}


