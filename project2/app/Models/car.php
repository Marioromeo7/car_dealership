<?php

namespace App\Models;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class car extends Model
{
    use HasFactory,SoftDeletes;
    protected $table='car';
    protected $fillable=[

'model_id',
'maker_id',
'year',
'price',
'vin',
'mileage',
'car_type_id',
'fuel_type_id',
'city_id',
'user_id',
'address',
'phone',
'description',
'published_at',
'created_at',
'updated_at',
'deleted_at',
    ];
    function CarType():BelongsTo
    {
        return $this->belongsTo(carType::class,'car_type_id','id');
    }
    function fuelType():BelongsTo
    {
        return $this->belongsTo(fuelType::class,'fuel_type_id','id');
    }
    function maker():BelongsTo
    {
        return $this->belongsTo(maker::class,'maker_id','id');
    }
    function model():BelongsTo
    {
        return $this->belongsTo(model::class,'model_id','id');
    }
    function owner():BelongsTo
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
    function city():BelongsTo
    {
        return $this->belongsTo(city::class,'city_id','id');
    }
    function carFeature():hasOne
    {
        return $this->hasOne(carFeature::class,'car_id','id');
    }
    function PrimaryImage():HasOne
    {
        return $this->hasOne(carImage::class,'car_id','id')->oldestOfMany('position');
    }
    function Images():HasMany
    {
        return $this->hasMany(carImage::class,'car_id','id');
    }

    function favoredUsers():BelongsToMany
    {
        return $this->belongsToMany(User::class,'fav_car','car_id','user_id');
    }
    function formatCreationDate()
    {
        return (new Carbon($this->created_at))->format('Y-m-d');
    }

}
