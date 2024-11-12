<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountAttribute extends Model
{
    use HasFactory;

    protected $fillable = [
        'account_id',
        'attribute_name',
        'attribute_value',
    ];

    public function accounts()
    {
        return $this->hasMany(Account::class);
    }
}
