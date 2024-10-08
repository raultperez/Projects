<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['total', 'cart_id'];

    public function cart(){
        return $this->belongsTo(Cart::class);
    }

    public function proposals() {
        return $this->belongsToMany(Proposal::class, 'order_proposals', 'order_id', 'proposal_id');
    }
}
