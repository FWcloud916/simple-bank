<?php

namespace Database\Factories;

use App\Models\AccountRecord;
use Illuminate\Database\Eloquent\Factories\Factory;


class AccountRecordFactory extends Factory
{
    protected $model = AccountRecord::class;

    public function definition()
    {
        $amount = $this->faker->numberBetween(100, 1000);
        return [
            'user_id' => $this->faker->numberBetween(1, 10),
            'amount' => $amount,
            'type' => $this->faker->randomElement(['deposit', 'withdraw']),
            'balance' => $amount,
        ];
    }
}
