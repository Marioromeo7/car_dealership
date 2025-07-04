<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model as EloquentModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class model extends EloquentModel
{
    use HasFactory;
    protected $table='model';
    public $timestamps=false;
    protected $fillable=['name','maker_id'];
    function maker(): BelongsTo{
        return $this->belongsTo(maker::class,'maker_id','id');
    }
    function cars():HasMany{
        return $this->hasMany(car::class,'model_id','id');
    }
}
