<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;


    protected $fillable = [
        'game_id',
        'username',
        'password',
        'price',
        'status',
    ];

    public function game()
    {
        return $this->belongsTo(Game::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function accountGalleries()
    {
        return $this->hasMany(AccountGallery::class);
    }

    public function transactionHistory()
    {
        return $this->hasMany(TransactionHistory::class);
    }

    
}
