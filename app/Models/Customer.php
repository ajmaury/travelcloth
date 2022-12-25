<?php
namespace App\Models;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Customer extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $fillable = [
        'accountId',
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
    protected $hidden = [
        'password',
        'remember_token',
    ];
    
}
