<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class VerifyOTPTest extends TestCase
{
    use DatabaseMigrations;

    /**
    * @test
    */
    public function a_user_can_submit_otp_and_Get_verified()
    {
        $this->logInUser();
        $OTP = auth()->user()->cacheTheOTP();
        $this->post('/verifyOTP', ['OTP' => $OTP])->assertStatus(302);
        $this->assertDatabaseHas('users', ['isVerified' => 1]);
    }

    /**
    * @test
    */
    public function user_can_see_otp_verify_page()
    {
        $this->logInUser();
        $this->get('/verifyOTP')
        ->assertStatus(200)
        ->assertSee('Enter OTP');
    }
}
