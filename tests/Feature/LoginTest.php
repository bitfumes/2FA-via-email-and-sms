<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class LoginTest extends TestCase
{
    use DatabaseMigrations;

    /**
    * @test
    */
    public function after_login_user_can_not_access_home_page_until_verifired()
    {
        $this->logInUser();
        $this->get('/home')->assertRedirect('/verifyOTP');
    }

    /**
    * @test
    */
    public function after_login_user_can_access_home_page_if_verifired()
    {
        $this->logInUser(['isVerified' => 1]);
        $this->get('/home')->assertStatus(200);
    }

    /**
    * @test
    */
    public function a_user_can_select_opt_via_channel()
    {
        $this->get('/login')->assertSee('OTP via SMS');
    }
}
