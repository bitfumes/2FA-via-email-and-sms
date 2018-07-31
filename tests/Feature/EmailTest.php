<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Mail;
use App\Mail\OTPMail;

class EmailTest extends TestCase
{
    use DatabaseMigrations;

    /**
    * @test
    */
    public function an_otp_email_is_send_when_user_is_logged_in()
    {
        Mail::fake();
        $user = factory(User::class)->create();
        $res = $this->post('/login', ['email' => $user->email, 'password' => 'secret']);
        Mail::assertSent(OTPMail::class);
    }

    /**
    * @test
    */
    public function an_otp_email_is_not_send_if_credentials_are_incorrect()
    {
        Mail::fake();
        $this->withExceptionHandling();
        $user = factory(User::class)->create();
        $res = $this->post('/login', ['email' => $user->email, 'password' => 'asdfasdf']);
        Mail::assertNotSent(OTPMail::class);
    }

    /**
    * @test
    */
    public function otp_is_stored_in_cache_for_the_user()
    {
        $user = factory(User::class)->create();
        $res = $this->post('/login', ['email' => $user->email, 'password' => 'secret']);
        $this->assertNotNull($user->OTP());
    }
}
