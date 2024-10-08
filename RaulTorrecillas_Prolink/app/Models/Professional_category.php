<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Professional_category extends Model
{
    use HasFactory;

    protected $fillable = ['professional_id', 'category_id'];

    public function category() {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function professional() {
        return $this->belongsTo(Professional::class, 'professional_id');
    }
}
