<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountGallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'account_id',
        'image_path',
        'caption',
    ];

    public function account()
    {
        return $this->belongsTo(Account::class, 'account_id');
    }
}
