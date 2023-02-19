<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kyc_status extends Model
{
    use HasFactory;
    protected $table = "kyc_status";
    protected $fillable = [
        'status_name',
        'status_code',
    ];
}
