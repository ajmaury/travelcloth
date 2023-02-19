<?php
namespace App\Models;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\{Kyc,Country,State,City,Pincode};
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
        'employeeId',
        'hotelName',
        'companyName',
        'alternet_mobile',
        'image',
        'kyc_type',
        'kyc_document',
        'account_type',
        'kyc_status',
        'account_status',
        'address_line1',
        'address_line2',
        'country_id',
        'state_id',
        'city_id',
        'pincode_id',
        'mobile_verification_status'
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];
    public function kyc() 
    {
        return $this->hasMany(Kyc::class,'customer_id','id');
    }
    public function customerview() 
    {
        return $this->hasMany(
            Country::class,
            State::class,
            City::class,
            Pincode::class,
            'pincode_id',
            'city_id',
            'state_id',
            'country_id',
        );
    }
}
