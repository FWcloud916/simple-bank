<?php

namespace Tests\Feature\Controllers;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AccountRecordViewControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_see_account_info()
    {
        $account_record = $this->setNewAccountRecord(1000);

        $response = $this->actingAs($account_record->user)->get('/accounts');

        $response->assertStatus(200);
        $response->assertSee('帳戶資訊');
        $response->assertSee($account_record->user->id);
        $response->assertSee($account_record->user->account);
        $response->assertSee('1000');
    }

    public function test_can_see_account_records()
    {
        $account_record = $this->setNewAccountRecord(1000);

        $response = $this->actingAs($account_record->user)->get('/accounts/' . $account_record->user->id);

        $response->assertStatus(200);
        $response->assertSee('帳戶明細');

        $response->assertSee('金額');
        $response->assertSee('1000');
        $response->assertSee('存款金額');
        $response->assertSee('1000');
        $response->assertSee('日期');
        $response->assertSee($account_record->created_at->format('Y-m-d'));
    }

    public function test_can_see_account_deposit_record()
    {
        $account_record = $this->setNewAccountRecord(1000);


        $this->actingAs($account_record->user)->post('/api/accounts', [
            'amount' => 500,
            'type' => 'deposit',
        ]);

        $response = $this->actingAs($account_record->user)->get('/accounts/' . $account_record->user->id);

        $response->assertStatus(200);
        $response->assertSee('帳戶明細');
        $response->assertSee('金額');
        $response->assertSee('1000');
        $response->assertSee('500');
        $response->assertSee('存款金額');
        $response->assertSee('1000');
        $response->assertSee('1500');
    }

    public function test_can_see_account_withdraw_record()
    {
        $account_record = $this->setNewAccountRecord(1000);


        $this->actingAs($account_record->user)->post('/api/accounts', [
            'amount' => 200,
            'type' => 'withdraw',
        ]);

        $response = $this->actingAs($account_record->user)->get('/accounts/' . $account_record->user->id);

        $response->assertStatus(200);
        $response->assertSee('帳戶明細');
        $response->assertSee('金額');
        $response->assertSee('1000');
        $response->assertSee('-200');
        $response->assertSee('存款金額');
        $response->assertSee('1000');
        $response->assertSee('800');
    }
}
