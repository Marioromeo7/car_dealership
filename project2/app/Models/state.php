<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class state extends Model
{
    use HasFactory;
    protected $table='state';
    public $timestamps=false;
    protected $fillable=['name'];
    function cities():HasMany
    {
        return $this->hasMany(city::class,'state_id','id');
    }
    function cars():HasManyThrough
    {
        return $this->hasManyThrough(car::class,city::class,'state_id','city_id','id');
    }
}
