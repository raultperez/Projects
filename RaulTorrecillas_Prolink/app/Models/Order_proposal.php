<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_proposal extends Model
{
    use HasFactory;

    protected $fillable = ['order_id', 'proposal_id','n_hours','price'];

    public function order() {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function proposal() {
        return $this->belongsTo(Proposal::class, 'proposal_id');
    }
}
