<?php

namespace App\Http\Controllers\API\Mobil;

use App\Transaction;
use App\Transfer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\TransactionResource;
use App\Http\Requests\TransferRequest;

use App\Jobs\TransferJob;
use App\Http\Services\TranferService;

class TransferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transfers = TranferService::all(Auth::id());
        return TransactionResource::collection($transfers);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TransferRequest $request)
    {
        $value = $request->validated();
        $tranfer = TranferService::register($value);
        TransferJob::dispatch($tranfer->id);
        return new TransactionResource($tranfer);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transfer $tranfer)
    {
        return new TransactionResource($tranfer);
    }
}
