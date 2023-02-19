<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    use HasFactory;
    protected $table="quotes";
    protected $fillable = [
        'name',
        'mobile',
        'pickup_pincode',
        'dropup_pincode',
        'no_of_bag',
        'user_id',
    ];
}
