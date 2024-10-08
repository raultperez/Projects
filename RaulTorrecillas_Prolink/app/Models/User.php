<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'password', 'description', 'imageUrl'];

    public function professional(){
        return $this->hasOne(Professional::class);
    }

    public function company(){
        return $this->hasOne(Company::class);
    }
}
