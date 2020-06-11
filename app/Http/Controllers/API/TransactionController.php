<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Transaction;
use Illuminate\Http\Request;
use App\Http\Resources\TransactionResource;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transactions = Transaction::all();
        return response([
            'transactions' => TransactionResource($transactions),
            'message' => 'All transaction'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data,[
           'user_id'=>'required|numeric',
           'plan_id'=>'required|numeric',
           'subscription_id'=>'required|numeric'   
        ]);
        $transaction = new Transaction;
        $transaction->user_id = auth()->user()->id;
        $transaction->plan_id = $request->plan_id;
        $transaction->subscription_id = $request->subscription_id;

        $transaction = Transaction::create($data);
        return response([
            'transaction' =>new TransactionResource($transaction),
            'message' => 'Transaction saved'
        ],200);   
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        return response([
            'transaction'=> new TransactionResource($transaction),
            'message' => 'Transaction retrieved'
        ],200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        $transaction->update($request->all());
        return response([
            'transaction'=>new TransactionResource($transaction),
            'message' => 'Transaction updated'
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
        return response([
            'message'=>'Transaction deleted'
        ]);
    }
}
