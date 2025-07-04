<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class carImage extends Model
{
    use HasFactory;
    protected $table='car_image';
    public $timestamps=false;
    protected $fillable=['img_path','position'];
    function car():belongsTo
    {
        return $this->belongsTo(car::class,'car_id','id');
    }
}
