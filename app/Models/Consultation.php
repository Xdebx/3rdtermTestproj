<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    use HasFactory;
    public $table = 'health_consultation';
    public $primaryKey = 'consult_id';
    public $timestamps = true;

    protected $guarded = ['consult_id','img_path'];
    protected $fillable = ['pet_id',
        'emp_id','observation','consult_cost'
    ];

   public static $rules = [ 
                'pet_id' =>'required',
                'emp_id'=>'required',
                'observation'=>'required',
                'consult_cost'=>'numeric',
             ];

    public function pet()
    {
        return $this->belongsTo('App\Models\Pet', 'pet_id');
    }

    public function disease(){
        // return $this->belongsToMany('App\Models\Disease', 'disease_id')->withPivot('consult_disease');
        return $this->belongsToMany('App\Models\Disease');
    }

    public function employee() 
    {
        return $this->belongsTo('App\Models\Employee','emp_id');
    }

}






