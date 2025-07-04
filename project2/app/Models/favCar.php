<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class favCar extends Model
{
    use HasFactory;
    protected $table='fav_car';
    public $timestamps=false;
    protected $fillable=['car_id','user_id'];
}
