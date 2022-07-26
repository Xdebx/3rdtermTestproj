<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Transaction;

class GroomingService extends Model 
{
   public $primaryKey = 'service_id';
   public $table = 'grooming_service';
   public $timestamps = false;
   protected $fillable = ['service_name','service_cost','img_path'];
    // public $searchableType = 'List of Service';
    
    public function transactions() {
    return $this->belongsToMany(Transaction::class,'groomingline','groominginfo_id','service_id');
    // return $this->belongToMany(Order::class);
  }
    
}
