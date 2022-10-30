<?php

namespace App\Http\Controllers;

use App\Traits\ApiTrait;

class AccountRecordViewController extends Controller
{
    use ApiTrait;

    public function index()
    {
        $user = auth()->user();
        return view('account_records.index', [
            'data' => [
                'id' => $user->id,
                'account' => $user->account,
                'balance' => $user->getLastBalance(),
            ],
        ]);
    }

    public function show(int $user_id)
    {
        $user = auth()->user();
        if ($user->id !== $user_id) {
            abort(403, 'You are not authorized to view this account record.');
        }
        $records = $user->accountRecords()->get();
        return view('account_records.show', [
            'records' => $records,
        ]);
    }
}
