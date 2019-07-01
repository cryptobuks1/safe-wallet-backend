<?php

namespace App\Http\Controllers\API\Mobil;

use App\Transaction;
use App\Transfer;
use App\User;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use App\Http\Services\TranferService;
use App\Http\Resources\TransactionResource;
use App\Http\Requests\TransferRequest;
use App\Http\Resources\Transfer\UserResource;

use App\Jobs\TransferJob;

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
     * validate a code
     * @return \Illuminate\Http\Response
     */
    public function validateCode(Request $request)
    {
        $code = $request->input('code');
        $user = User::where('code', $code)->select(['id', 'name', 'code'])->firstOrFail();
        return new UserResource($user);
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
        $tranfer = TranferService::register($value, Auth::id());
        // TransferJob::dispatch($tranfer->id);
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
