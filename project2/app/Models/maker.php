<?php

namespace App\Models;
use Database\Factories\MakerFactory;
use Faker\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class maker extends Model
{
    use HasFactory;
    protected $table='maker';
    public $timestamps=false;
    protected $fillable=['name'];
    function cars():HasMany{
        return $this->hasMany(car::class,'maker_id','id');
    }
    function models():HasMany{
        return $this->hasMany(\App\Models\model::class,'maker_id','id');
    }
    protected static function newFactory(): MakerFactory|\Illuminate\Database\Eloquent\Factories\Factory
    {
        return MakerFactory::new();
    }
}
