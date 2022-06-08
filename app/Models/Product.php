<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    
    protected $fillable = ['name', 'merk', 'sell_price', 'buy_price', 'supplier_id', 'category_id', 'stock'];

    public function supplier()
    {
        return $this->belongsTo('App\Models\Supplier', 'supplier_id');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id');
    }

    public function transactionDetail(){
        return $this->hasMany('App\Models\TransactionDetail', 'transaction_id');
    }
}
