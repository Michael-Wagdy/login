<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OfferCategory extends Model
{
    //
    protected $table = 'offer_category';
    protected $fillable = [
        'offer_id','category_id',
    ];
    public $timestamps = false;



    public function OfferCategories(){
        return $this->hasMany(Offer::class);
    }

}
