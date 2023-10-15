<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    use HasFactory;


    protected $fillable = ['id', 'locations', 'startLocation'];

    function getRouteTour()
    {
        return $this->hasMany('App\Models\Route_Tour');
    }

    public function routes()
    {
        return $this->belongsToMany('App\Models\Route', 'route_tour');
    }

    public function media()
    {
        return $this->belongsToMany('App\Models\Media', 'route_tour', 'tour_id', 'information_id');
    }
}
