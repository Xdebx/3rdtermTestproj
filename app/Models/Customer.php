<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Customer extends Model
{
    use HasFactory;

    public $table = 'customers';
    public $primaryKey = 'customer_id';
    public $timestamps = true;

    protected $guarded = ['customer_id','img_path'];
    protected $fillable = ['fname','lname',
        'title','addressline','zipcode',
        'phone','img_path'
    ];

   public static $rules = [ 
               'title' =>'required|min:3',
               'lname'=>'required|alpha',
               'fname'=>'required',
                'addressline'=>'required',
                'phone'=>'numeric',
                'zipcode'=>'required',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg'
             ];

    public function pets()
    {
        return $this->hasMany('App\Models\Pet', 'customer_id');
    }

    public function users()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}
