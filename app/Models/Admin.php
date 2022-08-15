<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;
    public $table = 'admins';
    public $primaryKey = 'admin_id';
    public $timestamps = true;

    protected $guarded = ['admin_id','img_path'];
    protected $fillable = ['fname','addresslinee','img_path'];

   public static $rules = [ 
                'fname'=>'required',
                'addressline'=>'required',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg'
             ];

    public function users()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}
