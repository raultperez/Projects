<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends User
{
    use HasFactory;

    protected $fillable = ['location'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function cart(){
        return $this->hasOne(Cart::class);
    }
}
