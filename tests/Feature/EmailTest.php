<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Mail;
use App\Mail\OTPMail;
use Illuminate\Support\Facades\Notification;
use App\Notifications\OTPNotification;

class EmailTest extends TestCase
{
    use DatabaseMigrations;
    public $user;

    public function setup()
    {
        parent::setUp();
        $this->user = factory(User::class)->create();
    }

    /**
    * @test
    */
    public function an_otp_email_is_send_when_user_is_logged_in()
    {
        Notification::fake();
        $res = $this->post('/login', ['email' => $this->user->email, 'password' => 'secret', 'via' => 'email']);
        Notification::assertSentTo([$this->user], OTPNotification::class);
    }

    /**
    * @test
    */
    public function an_otp_email_is_not_send_if_credentials_are_incorrect()
    {
        Mail::fake();
        $this->withExceptionHandling();
        $res = $this->post('/login', ['email' => $this->user->email, 'password' => 'asdfasdf']);
        Mail::assertNotSent(OTPMail::class);
    }

    /**
    * @test
    */
    public function otp_is_stored_in_cache_for_the_user()
    {
        $res = $this->post('/login', ['email' => $this->user->email, 'password' => 'secret']);
        $this->assertNotNull($this->user->OTP());
    }
}
