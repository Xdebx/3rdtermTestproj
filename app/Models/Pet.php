<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Pet extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $table = 'pets';
    public $primaryKey = 'pet_id';
    public $timestamps = true;

    protected $guarded = ['pet_id','img_path'];
    protected $fillable = ['customer_id','breed','pname','gender','age','img_path'];

   public static $rules = [ 
               'customer_id' =>'required',
               'pname'=>'required',
               'breed'=>'required',
                'gender'=>'required',
                'age'=>'numeric',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg'
             ];

    public function customers() 
    {
        return $this->belongsTo('App\Models\Customer', 'customer_id')->withTrashed();
        // return $this->belongsTo(Customer::class, 'customer_id');
       
    }

    public function consults(){
        return $this->hasMany('App\Models\Consultation', 'pet_id');
    }
}
