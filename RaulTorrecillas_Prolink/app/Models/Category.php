<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function proposals()
    {
        return $this->hasMany(Proposal::class);
    }

    public function professionals() {
        return $this->belongsToMany(Professional::class, 'professional_categories', 'category_id', 'professional_id');
    }
}
