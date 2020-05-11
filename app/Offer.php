<?php

namespace App;

use Illuminate\Support\Carbon;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    //
    protected $dates = [ 'start_date','end_date','created_at', 'updated_at','deleted_at']; 
    protected $fillable = [
        'name','agency_price', 'user_price','start_date','end_date','no_rooms','status','agency_id'
    ];

    protected $hidden =[
        'agency_id'
    ];
    
    

    const Transporation_SELECT = [
        'bus' => 'bus',
        'train' => 'train',
    ];
    
    // public function getStartDateAttribute($input)
    // {
    //     return         Carbon::create($input)->format('l jS \\of F Y h:i A');

    // }
    public function setStartDateAttribute($input)
    {
        $this->attributes['start_date'] = 
        Carbon::create($input)->toDateTimeString();
    }
    // public function getEndDateAttribute($input)
    // {
    //     return         Carbon::create($input)->format('l jS \\of F Y h:i A');

    // }
    public function setEndDateAttribute($input)
    {
        $this->attributes['end_date'] = 
        Carbon::create($input)->toDateTimeString();
    }


    public function agency(){
        return  $this->belongsTo(Agency::class);
      }
    public function details(){
        return $this->hasMany(OfferDetail::class);
    }

    public function photo(){
        return $this->hasMany(Photo::class);
    }
    public function categories(){
        return  $this->belongsToMany(Category::class,'offer_category','offer_id','category_id');
      }
  
    
}
