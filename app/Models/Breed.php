<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Breed extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $table = 'pet_breed';
    public $primaryKey = 'petb_id';
    public $timestamps = true;

    protected $guarded = ['petb_id'];
    protected $fillable = ['pbreed'];
    public static $rules = ['pbreed'=>'required'];


    public function pets()
    {
        return $this->hasMany('App\Models\Pet', 'petb_id');
    }
}
