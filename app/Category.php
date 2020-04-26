<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $fillable = [
        'name',
    ];
    public $timestamps = false;



    public function OfferCategories(){
        return $this->belongsToMany(Offer::class,'offer_category','offer_id','category_id');
    }

}
