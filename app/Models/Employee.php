<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $table = 'customers';
    protected $fillable = [
        'accountId',
        'employeeId',
        'fname',
        'lname',
        'email',
        'password',
        'mobile',
        'alternet_mobile',
        'image',
        'kyc_type',
        'kyc_document',
        'account_type',
        'kyc_status',
        'account_status',
        'remember_token',
    ];
}
