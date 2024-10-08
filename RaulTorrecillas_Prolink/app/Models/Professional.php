<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Professional extends User
{
    use HasFactory;

    protected $fillable = ['surname', 'age', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function proposals()
    {
        return $this->hasMany(Proposal::class);
    }

    public function working_experiences()
    {
        return $this->hasMany(Working_experience::class);
    }

    public function categories() {
        return $this->belongsToMany(Category::class, 'professional_categories', 'professional_id', 'category_id');
    }
}
