<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id','courier_id','status','name','phone', 'email', 'street','house','apart', 'sum'
    ];

    protected $hidden = [
        'remember_token',
    ];
}
