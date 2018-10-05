<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $records = Product::all();
        return view('admin.Product.index',compact('records'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        $input = $request->all();
        Product::create($input);
        return redirect()->back()->with([
            'success' => 'Product Created.'
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        $record = Product::find($id);
        $record->update($request->all());
        return redirect()->back()->with([
            'success' => 'Record Updated Successfully.'
        ]);
    }

    public function destroy($id)
    {
        $record = Product::find($id);
        $record->delete();
        return redirect()->back()->with([
            'success' => 'Record Deleted Successfully.'
        ]);
    }

    public function searchProduct(Request $request)
    {
        if(!empty($request['name'])) {
            $products = Product::where('name','LIKE',$request['name'].'%')->get();
            return view('admin.ProductSell.get_products',compact('products'));
        }
    }
}