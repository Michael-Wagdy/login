<?php

namespace App;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;

class OfferDetail extends Model
{
    //
    protected $dates = [ 'Departial_time','arrival_time']; 

    protected $fillable= ['to', 'from', 'no_trip','transportation_mode','offer_id' ,'Departial_time','arrival_time'];

    protected $hidden = ['offer_id'];
    public $timestamps = false;

        public function offer(){
            return  $this->belongsTo(offer::class);
          }
        //   public function getArrivalTimeAttribute($input)
        //   {
        //       return         Carbon::create($input)->toDateTimeString();

        //   }
          public function setArrivalTimeAttribute($input)
          {
              $this->attributes['arrival_time'] = 
                Carbon::create($input)->toDateTimeString();
          }
        //   public function getDepartialTimeAttribute($input)
        //   {
        //       return         Carbon::create($input)->toDateTimeString();

        //   }
          public function setDepartialTimeAttribute($input)
          {
              $this->attributes['Departial_time'] = 
              Carbon::create($input)->toDateTimeString();
            }
      
}
