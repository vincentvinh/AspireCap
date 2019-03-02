<?php

namespace App\Http\Controllers;

use App\Loan;
use App\Repayment;
use Carbon\Carbon;
use Faker\Provider\DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use phpseclib\Crypt\Hash;

class LoanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     * @param  \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */

    public function create(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'amount' => 'required|integer',
            'duration' => 'required|integer',
            'repayment_frequency' => 'required|integer',
            'interest_rate' => 'required|integer',
            'fee' => 'required|integer',
        ]);

        $loan = Loan::create([
            'user_id' => $user->id,
            'amount' => $request->amount,
            'duration' => $request->duration,
            'repayment_frequency' => $request->repayment_frequency,
            'interest_rate' => $request->interest_rate,
            'fee' => $request->fee,
        ]);
        $dtz = new \DateTimeZone("Europe/Madrid"); //Your timezone
        $now = new \DateTime(date("Y-m-d"), $dtz);

        for ($i = 0; $i< $request->duration;$i++)
        {
            $now->add(new \DateInterval('P1M'));

            Repayment::create([
                'loan_id' => $loan->id,
                'time_to_pay' => Carbon::parse($now->format('Y-m-d H:i:s')),
                'amount_to_pay' => $request->amount_to_pay,
            ]);
        }

        return response()->json(['Loan created successfully', Loan::with(['repayments'])->find($loan->id)], 200);


    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function get()
    {
        $user = auth()->user();
        return response()->json(['Loan retrieved successfully', Loan::with(['repayments'])->where('user_id', $user->id)->get()], 200);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function schedule($id)
    {
        $user = auth()->user();
        return response()->json(['Schedule retrieved successfully', Loan::with(['repayments'])->where('user_id', $user->id)->where('id', $id)->get()], 200);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function show(Loan $loan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function edit(Loan $loan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Loan $loan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Loan $loan)
    {
        //
    }
}
