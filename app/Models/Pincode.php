<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelUserActivity\Traits\Loggable;


class Pincode extends Model
{
    use HasFactory, Loggable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = "pincodes";
    protected $fillable = [
        'pincode',
        'city_id',
        'oda',
    ];

    public function state()
    {
        return $this->belongsTo(City::class,'city_id');
    }

}
