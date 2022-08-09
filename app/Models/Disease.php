<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disease extends Model
{
    use HasFactory;

    public $table = 'disease_injuries';
    public $primaryKey = 'disease_id';
    public $timestamps = true;

    protected $guarded = ['disease_id'];
    protected $fillable = ['disease_name'];
    public static $rules = ['disease_name'=>'required'];

    public function consults()
    {
        // return $this->belongsToMany('App\Models\Consultation', 'disease_id')->withPivot('consult_disease');
        return $this->belongsToMany('App\Models\Consultation');
    }
}
