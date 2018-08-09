<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use App\User;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function setup()
    {
        parent::setUp();
        $this->withoutExceptionHandling();
    }

    public function logInUser($args = [])
    {
        $user = factory(User::class)->create($args);
        $this->actingAs($user);
        return $user;
    }
}
