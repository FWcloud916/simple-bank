<?php

namespace Tests\Feature\Controllers;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AccountRecordControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_get_account_info()
    {
        $account_record = $this->setNewAccountRecord(1000);

        $response = $this->actingAs($account_record->user)->get('/api/accounts');
        $result = $response->json()['data'];

        $response->assertStatus(200);
        $this->assertEquals($account_record->user->id, $result['id']);
        $this->assertEquals($account_record->user->account, $result['account']);
        $this->assertEquals(1000, $result['balance']);
    }

    public function test_can_get_account_records()
    {
        $account_record = $this->setNewAccountRecord(1000);

        $response = $this->actingAs($account_record->user)->get("/api/accounts/" . $account_record->user->id);
        $result = $response->json()['data'];

        $response->assertStatus(200);
        $this->assertEquals($account_record->user->id, $result[0]['user_id']);
        $this->assertEquals(1000, $result[0]['amount']);
        $this->assertEquals('deposit', $result[0]['type']);
        $this->assertEquals(1000, $result[0]['balance']);
    }

    public function test_can_add_account_record()
    {
        $account_record = $this->setNewAccountRecord(1000);

        $record_count = $account_record->user->accountRecords()->count();

        $response = $this->actingAs($account_record->user)->post("/api/accounts", [
            'amount' => 1000,
            'type' => 'deposit',
        ]);
        $result = $response->json()['data'];

        $response->assertStatus(200);
        $this->assertEquals($account_record->user->id, $result['user_id']);
        $this->assertEquals(1000, $result['amount']);
        $this->assertEquals('deposit', $result['type']);
        $this->assertEquals(2000, $result['balance']);
        $this->assertGreaterThan(0, $result['amount_change']);
        $this->assertGreaterThan($record_count, $account_record->user->accountRecords()->count());
    }

    public function test_can_add_account_record_with_withdraw()
    {
        $account_record = $this->setNewAccountRecord(1000);

        $record_count = $account_record->user->accountRecords()->count();

        $response = $this->actingAs($account_record->user)->post("/api/accounts", [
            'amount' => 1000,
            'type' => 'withdraw',
        ]);
        $result = $response->json()['data'];

        $response->assertStatus(200);
        $this->assertEquals($account_record->user->id, $result['user_id']);
        $this->assertEquals(1000, $result['amount']);
        $this->assertEquals('withdraw', $result['type']);
        $this->assertEquals(0, $result['balance']);
        $this->assertLessThan(0, $result['amount_change']);
        $this->assertGreaterThan($record_count, $account_record->user->accountRecords()->count());
    }

    public function test_cannot_make_account_balance_less_than_zero()
    {
        $account_record = $this->setNewAccountRecord(1000);

        $response = $this->actingAs($account_record->user)->post("/api/accounts", [
            'amount' => 2000,
            'type' => 'withdraw',
        ]);
        $result = $response->json();

        $response->assertStatus(422);
        $this->assertEquals('Balance is not enough', $result['message']);
    }
}
