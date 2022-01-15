<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class property extends Model
{
    use HasFactory;

    protected $fillable =['property_name'];


    public function job(){
        return $this->belongsTo('App\Models\Job');
    }

}


