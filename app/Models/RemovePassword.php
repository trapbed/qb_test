<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RemovePassword extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'date_add'
    ];

    protected $hidden = [
        'remember_token',
    ];
}
