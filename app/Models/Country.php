<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;
    protected $table = "countrys";
    protected $fillable = [
        'country_name',
        'status'
    ];
    public function state()
    {
        return $this->hasMany(State::class);
    }
}
