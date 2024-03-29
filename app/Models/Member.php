<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'position','gender' , 'phone_number', 'address', 'email'];

    public function transactions(){
        return $this->hasMany('App\Models\Transaction', 'member_id');
    }
}
