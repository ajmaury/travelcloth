<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelUserActivity\Traits\Loggable;


class City extends Model
{
    use HasFactory, Loggable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = "citys";
    protected $fillable = [
        'city_name',
        'pincode',
        'state_id',
        'status',
    ];

    public function state()
    {
        return $this->belongsTo(State::class,'state_id');
    }

}
