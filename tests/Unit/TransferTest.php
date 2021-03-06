<?php

namespace Tests\Unit;

use Tests\TestCase;

use App\Http\Services\TranferService;

use App\Exceptions\InsufficientFoundException;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Transfer;
use App\User;

class TransferTest extends TestCase
{
    /**
     * A basic unit test example.
     * @return void
     */
    public function testMakeToTransfer()
    {
        [$user, $user2] = factory(User::class, 2)->create();
        $balance  = $user->balance()->first()->balance;
        $balance2 = $user2->balance()->first()->balance;
        $tranfer = TranferService::register([
            'code' => $user2->code,
            'amount' => 10,
            'commentary' => 'I\'m a comment'
        ], $user->id);
        TranferService::process($tranfer->id);
        $this->assertEquals($balance - 10, $user->balance()->first()->balance);
        $this->assertEquals($balance + 10, $user2->balance()->first()->balance);
    }

    /**
     * A basic unit test example.
     * @return void
     */
    public function testMakeToTransferWithoutEnoughFunds()
    {
        $this->expectException(InsufficientFoundException::class);
        [$user, $user2] = factory(User::class, 2)->create();
        $tranfer = TranferService::register([
            'code' => $user2->code,
            'amount' => 1000.00,
            'commentary' => 'I\'m a comment'
        ], $user->id);
    }
}
