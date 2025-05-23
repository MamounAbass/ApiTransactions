<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use  App\Models\User;
use  App\Models\Transaction;

class Buyer extends User
{
    use HasFactory;

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
