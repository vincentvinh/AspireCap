<?php

namespace App\Http\Controllers;

use App\Repayment;
use Illuminate\Http\Request;

class RepaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        Repayment::where('id', $id)->update(['payed' => 1]);
        return response()->json(['payed successfully', 200);
    }

    /**
     * Show the form for creating a new resource.
     * @param $id
     * @param Request
     * @return \Illuminate\Http\Response
     */
    public function pay(Request $request, $id)
    {

        $repay = Repayment::where('id', $id)->get();

        if ($request->amount == $repay->amount && $repay->payed !=1)
        {
            Repayment::where('id', $id)->update(['payed' => 1]);

            return response()->json('payed successfully', 200);
        }
        else
        {
            return response()->json('Already payed or the amount is not good', 200);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Repayment  $repayment
     * @return \Illuminate\Http\Response
     */
    public function show(Repayment $repayment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Repayment  $repayment
     * @return \Illuminate\Http\Response
     */
    public function edit(Repayment $repayment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Repayment  $repayment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Repayment $repayment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Repayment  $repayment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Repayment $repayment)
    {
        //
    }
}
