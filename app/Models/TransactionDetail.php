<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    use HasFactory;
    protected $fillable = ['transaction_id', 'product_id', 'quantity', 'sub_total'];

    public function transaction(){
        return $this->belongsTo ('App\Models\Transaction', 'transaction_id');
    }

    public function products(){
        return $this->belongsTo('App\Models\Product', 'product_id');
    }
}
