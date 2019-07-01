<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'user'  => [
                'id' => $this->user->id,
                'code' => $this->user->code,
                'name' => $this->user->name,
            ],
            'beneficiary' => [
                'id' => $this->beneficiary->id,
                'code' => $this->beneficiary->code,
                'name' => $this->beneficiary->name,
            ],
            'commentary' =>  $this->commentary,  
            'source' => [
                'id' =>  $this->source->id,
                'amount' => $this->source->amount,
                'detail' => $this->source->detail,
                'status' => $this->source->status
            ],
            'destination' => [
                'id' =>  $this->destination->id,
                'amount' => $this->destination->amount,
                'detail' => $this->destination->detail,
                'status' => $this->destination->status
            ]
        ];
    }
}
