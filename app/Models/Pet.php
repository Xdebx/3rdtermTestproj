<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Pet extends Model
{
    use HasFactory;

    public $table = 'pets';
    public $primaryKey = 'pet_id';
    public $timestamps = true;

    protected $guarded = ['pet_id','img_path'];
    protected $fillable = ['customer_id','petb_id','pname','gender','age','img_path'];

   public static $rules = [ 
               'customer_id' =>'required',
               'petb_id'=>'required',
               'pname'=>'required',
                'gender'=>'required',
                'age'=>'numeric',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg'
             ];

    public function customers() 
    {
        return $this->belongTo('App\Models\Customer', 'pet_id');
        
    }
}
