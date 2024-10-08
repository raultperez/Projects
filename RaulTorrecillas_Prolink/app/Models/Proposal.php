<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Proposal extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'price_hour', 'imageUrl','professional_id','category_id'];

    public function professional(): BelongsTo
    {
        return $this->belongsTo(Professional::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function carts() {
        return $this->belongsToMany(Cart::class, 'cart_proposals', 'proposal_id', 'cart_id');
    }

    public function orders() {
        return $this->belongsToMany(Order::class, 'order_proposals', 'proposal_id', 'order_id');
    }

}
