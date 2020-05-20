<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    use SoftDeletes;
    protected $dates = ['created_at', 'updated_at','deleted_at']; 

    protected $fillable = [
        'name','parent_id'
    ];
    public $timestamps = false;



    public function OfferCategories(){
        return $this->belongsToMany(Offer::class,'offer_category','offer_id','category_id');
    }
    public function categoryParent(){
        return $this->belongsTo('App\Category', 'parent_id');
    }
    
    public function categoryChildren(){
        return $this->hasMany('App\Category', 'parent_id');
    }
}
