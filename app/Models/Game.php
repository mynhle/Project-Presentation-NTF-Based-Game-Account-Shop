<?php

namespace App\Models;

use App\Models\Account;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'image',
        'accounts_count',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];


    public function accounts()
    {
        return $this->hasMany(Account::class);
    }
}
