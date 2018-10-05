<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductSell;
use App\Student;
use Illuminate\Http\Request;

class ProductSellController extends Controller
{
    public function index()
    {
        return view('admin.ProductSell.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        return $request->all();
        $stu = Student::find($request['student_id']);
        foreach($request['id'] as $key => $id) {
            ProductSell::create([
                'student_id' => $stu->id,
                'student_roll' => $stu->roll,
                'sclass_id' => $stu->sclass_id,
                'session' => $stu->session,
                'exam_id' => $request['exam_id'],
                'section_id' => $stu->section_id,
                'group_id' => $stu->group_id,
                'product_id' => $id,
                'quantity' => $request['quantity'][$key],
                'price' => $request['price'][$key],
                'total_amount' => $request['price'][$key] * $request['quantity'][$key],
                'sell_date' => $request['sell_date'],
                'year' => date("Y"),
                'month' => date("m")
            ]);
        }

        return redirect()->back()->with([
           'success' => 'Product Send'
        ]);
    }

    public function printItems()
    {
        return view('admin.ProductSell.print_items');
    }

    public function studentHistory(Request $request)
    {
        $from = $request['from'];
        $to = $request['to'];
        $student = Student::find($request['id']);
        $option = $request['option'];


        $invoices = ProductSell::where('student_id',$student->id)
            ->whereBetween('sell_date',array($from,$to))
            ->get();

        return view('admin.ProductSell.get_sell_items',compact('from','to','student','invoices','option'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $record = ProductSell::find($id);
        $request['total_amount'] = $request['quantity'] * $request['price'];
        $record->update($request->all());
        return redirect()->back()->with([
           'success' => 'Product Sell Updated'
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
        $record = ProductSell::find($id);
        $record->delete();
        return redirect()->back()->with([
            'success' => 'Product Deleted Updated'
        ]);
    }

    public function searchStudent(Request $request)
    {
        $student = Student::find($request['id']);
        return view('admin.ProductSell.get_student',compact('student'));
    }
}
