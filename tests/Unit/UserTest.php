<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Http\Services\UserService;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @return void
     */
    public function testAll()
    {
        $input = 'test';
        $all = UserService::all( $input);
        $this->assertNotNull( $all);
    }

    /**
     * @return void
     */
    public function testRegister()
    {
        $value = [
            'name' => 'Angelica Maria' , 
            'email' => 'Angelica@gmail.com', 
            'password' => '123456'
        ];
        $user = UserService::register( $value);
        $this->assertNotNull( $user);
        $this->assertNotNull( $user->balance()->get());
        $this->assertEquals( $user->balance->balance, 100.00);

    }

}
