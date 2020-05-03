<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactUS extends Model
{
    //


    const SUBJECT_SELECT = [
        'complain'=> 'complain',
        'inquire'=>'inquire',
        'request'=>'request',
        'other'=>'other'

    ];
    protected $table ='contact_us';
    protected $fillable = ['frist_name','last_name','email','subject','status','message'];

    protected $dates = ['created_at', 'updated_at'];

    public function user(){
        return $this->belongsto(User::class);
    }
}
