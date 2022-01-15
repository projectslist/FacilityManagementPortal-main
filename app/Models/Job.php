<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Job extends Model
{
    use HasFactory;


    protected $fillable = [
        'summary',
        'description',
        'property_id',
        'user_id',
        'status',

    ];
    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function property(){
        return $this->hasMany('App\Models\property');
    }

}
