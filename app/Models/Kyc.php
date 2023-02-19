<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Customer;
class Kyc extends Model
{
    use HasFactory;
    protected $table = "kyc";
    protected $fillable = [
        'customer_id',
        'gst_certificate',
        'c_incorporation',
        'aadhar_front',
        'aadhar_back',
        'passport_1',
        'passport_2',
        'voterid_front',
        'voterid_back',
        'active_status',
    ];
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
