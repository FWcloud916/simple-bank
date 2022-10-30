<?php

namespace App\Http\Controllers;

use App\Enums\AccountRecordType;
use App\Http\Requests\AccountRecordRequest;
use App\Models\AccountRecord;
use App\Traits\ApiTrait;

class AccountRecordController extends Controller
{
    use ApiTrait;

    public function index()
    {
        $user = auth()->user();
        $data = [
            'id' => $user->id,
            'account' => $user->account,
            'balance' => $user->getLastBalance(),
        ];
        return $this->successResponse('Account records fetched successfully', $data);
    }

    public function show($user_id)
    {
        $user = auth()->user();
        if ($user->id !== (int) $user_id) {
            return $this->return403Response('You are not authorized to view this account record.');
        }
        $records = $user->accountRecords()->get();
        return $this->successResponse('Account records fetched successfully', $records);
    }

    public function store(AccountRecordRequest $request)
    {
        $user = auth()->user();
        $last_balance = 0;
        $last_record = AccountRecord::where('user_id', $user->id)->latest()->first();
        if ($last_record) {
            $last_balance = $last_record->balance;
        }

        $type = $request->enum('type', AccountRecordType::class);

        $balance = $this->calBalance($last_balance, $request->amount, $type);
        if ($balance < 0) {
            return $this->return422Response('Balance is not enough');
        }

        $record = AccountRecord::create([
            'user_id' => $user->id,
            'amount' => $request->amount,
            'type' => $type,
            'balance' => $balance,
        ]);

        return $this->successResponse('Account record created successfully', $record);
    }


    /**
     * @param  int                $last_balance
     * @param  int                $amount
     * @param  AccountRecordType  $type
     *
     * @return int
     */
    private function calBalance(int $last_balance, int $amount, AccountRecordType $type): int
    {
        return $last_balance + ($type === AccountRecordType::DEPOSIT ? $amount : -$amount);
    }
}
