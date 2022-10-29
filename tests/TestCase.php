<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function setNewUser(
        string $email = 'test@example.com',
        string $password = 'password'
    ) {
        return User::Factory()->create(
            [
                'name' => 'Test User',
                'email' => $email,
                'account' => 'Test Account',
                'password' => bcrypt($password),
            ]
        );
    }
}
