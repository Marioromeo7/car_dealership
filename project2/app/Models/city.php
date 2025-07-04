<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class city extends Model
{
    use HasFactory;
    protected $table='city';
    public $timestamps=false;
    protected $fillable=['name','state_id'];
    function state():BelongsTo
    {
        return $this->belongsTo(state::class,'state_id','id');
    }
    function cars():HasMany{
        return $this->hasMany(car::class,'city_id','id');
    }
}
