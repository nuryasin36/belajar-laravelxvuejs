<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'phone_number', 'address'];

    public function user(){
        return $this->hasOne('App\Models\User', 'member_id');
    }

    public function transaction(){
        return $this->belongsTo('App\Models\Transaction', 'id');
    }
}
