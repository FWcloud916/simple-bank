<?php

namespace App\Models;

use App\Enums\AccountRecordType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountRecord extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $appends = [
        'amount_change'
    ];

    protected $fillable = [
        'user_id',
        'amount',
        'type',
        'balance',
    ];

    protected array $cast = [
        'type' => AccountRecordType::class,
    ];

    public function getAmountChangeAttribute(): int
    {
        if ($this->type instanceof AccountRecordType) {
            return $this->type === AccountRecordType::DEPOSIT ? $this->amount : -$this->amount;
        }
        return $this->type === 'deposit' ? $this->amount : -$this->amount;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
