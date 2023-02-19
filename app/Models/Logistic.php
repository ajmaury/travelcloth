<?php
namespace App\Models;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Logistic extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $fillable = [
        'logisticId',
        'cname',
        'cpname',
        'cpdesignation',
        'gstin',
        'bankname',
        'accountnumber',
        'ifsccode',
        'cpmobile',
        'status'
    ];
    
}
