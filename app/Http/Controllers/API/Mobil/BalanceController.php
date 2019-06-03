<?php

namespace App\Http\Controllers\API\Mobil;

use App\Balance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\BalanceResource;

class BalanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $balance = Auth::user()->balance();
        return new BalanceResource( $balance);
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

}
