<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id','name','current_price','old_price','image','weight', 'compound', 'new', 'hit', 'discount', 'date_remove'
    ];
}
