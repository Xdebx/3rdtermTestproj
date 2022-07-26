<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\Models\GroomingService;

class Transaction extends Model
{
    protected $table = 'grooming_info';
    protected $primaryKey = 'groominginfo_id';
    public $timestamps = false;
    protected $fillable = ['customer_id','date_placed','date_shipped','shipping','status'];
    
    public function customer() {
        return $this->belongsTo('App\Models\Customer');
    }
   
    public function services() {
        return $this->belongsToMany(GroomingService::class,'groomingline','groominginfo_id','service_id');
    }
}

