<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Notification;
use App\Notifications\OTPNotification;

class UserTest extends TestCase
{
    use DatabaseMigrations;

    /**
    * @test
    */
    public function it_has_cache_key_for_otp()
    {
        $user = factory(User::class)->create();
        $this->assertEquals($user->OTPKey(), 'OTP_for_1');
    }

    /**
    * @test
    */
    public function it_ca_send_a_OTP_notification_to_the_user()
    {
        $user = factory(User::class)->create();
        Notification::fake();
        $user->sendOTP('email');
        Notification::assertSentTo([$user], OTPNotification::class);
    }
}
