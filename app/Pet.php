<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    public function contact() {
        return $this->belongsTo('App\Contact');
    }
}
