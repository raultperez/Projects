<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart_proposal extends Model
{
    use HasFactory;

    protected $fillable = ['n_hours','price','cart_id', 'proposal_id'];

    public function cart() {
        return $this->belongsTo(Cart::class, 'cart_id');
    }

    public function proposal() {
        return $this->belongsTo(Proposal::class, 'proposal_id');
    }
}
