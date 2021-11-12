<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PickupTime extends Model
{
    protected $guarded=[];

    public function pickup_point(){
        return $this->belongsTo(PickupPoint::class);
    }
}
