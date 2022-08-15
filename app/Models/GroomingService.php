<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroomingService extends Model
{
    use HasFactory;

    public $primaryKey = 'service_id';
    public $table = 'grooming_service';
    public $timestamps = true;
    protected $fillable = ['service_name','service_cost','img_path'];

    public static $rules = [
     'service_name'=>'required',
     'service_cost'=>'required',
     'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg'
  ];
     // public $searchableType = 'List of Service';

     public function transacts() {
     return $this->belongsToMany(Transaction::class,'groomingline','groominginfo_id','service_id');
  }
  
}