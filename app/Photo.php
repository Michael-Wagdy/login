<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    //
    protected $fillable = [
        'photo','offer_id'
    ];
    protected $hidden = [
        'offer_id',
    ];
    protected $dates = ['created_at', 'updated_at']; 


    public function offer(){
        return $this->belongsTo(Offer::class);

    }
}
