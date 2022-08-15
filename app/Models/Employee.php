<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    public $table = 'employees';
    public $primaryKey = 'emp_id';
    public $timestamps = true;

    protected $guarded = ['emp_id','img_path'];
    protected $fillable = ['fname','lname', 'position','title','addressline','zipcode', 'phone','img_path'];

   public static $rules = [ 
               'title' =>'required|min:3',
               'position'=>'required|alpha',
               'lname'=>'required|alpha',
               'fname'=>'required',
                'addressline'=>'required',
                'phone'=>'numeric',
                'zipcode'=>'required',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg'
             ];

    public function users()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
    
    public function consults()
    {
        return $this->hasMany('App\Models\Consultation', 'emp_id');
    }
    public function transacts()
    {
        return $this->hasMany('App\Models\Transaction', 'emp_id');
    }
}
