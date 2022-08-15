<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'grooming_info';
    protected $primaryKey = 'groominginfo_id';
    public $timestamps = true;
    protected $fillable = ['pet_id','status'];
    
    public function customer() {
        return $this->belongsTo('App\Models\Customer');
    }

    public function employee() {
        return $this->belongsTo('App\Models\Employee');
    }

    public function pets() {
        return $this->belongsTo('App\Models\Pet','pet_id');
    }    

    public function services() {
        return $this->belongsToMany(GroomingService::class,'groomingline','groominginfo_id','service_id');
      }
}

