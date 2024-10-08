<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Working_experience extends Model
{
    use HasFactory;

    protected $fillable = ['begins_at', 'ends_at', 'company_name', 'description','professional_id'];

    public function professional()
    {
        return $this->belongsTo(Professional::class);
    }
}
