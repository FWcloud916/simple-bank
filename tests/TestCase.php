<?php

namespace Tests;

use App\Enums\AccountRecordType;
use App\Models\AccountRecord;
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

    protected function setNewAccountRecord(int $amount, $type = AccountRecordType::DEPOSIT)
    {
        $user = User::Factory()->create();
        return AccountRecord::Factory()->create(
            [
                'user_id' => $user->id,
                'amount' => $amount,
                'type' => $type,
                'balance' => $amount,
            ]
        );
    }
}
