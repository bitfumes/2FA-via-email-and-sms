<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

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

    /**
    * @test
    */
    public function invalid_otp_returns_error_message()
    {
        $this->logInUser();
        $this->post('/verifyOTP', ['OTP' => 'InvalidOTP'])->assertSessionHasErrors();
    }

    /**
    * @test
    */
    public function if_no_otp_is_given_then_it_return_with_error()
    {
        $this->withExceptionHandling();
        $this->logInUser();
        $this->post('/verifyOTP', ['OTP' => null])->assertSessionHasErrors(['OTP']);
    }
}
