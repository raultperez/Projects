<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = ['item_number','active','company_id'];

    public function company(){
        return $this->belongsTo(Company::class);
    }

    public function proposals() {
        return $this->belongsToMany(Proposal::class, 'cart_proposals', 'cart_id', 'proposal_id');
    }
}
