<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    use HasFactory;

    protected $fillable = ['start_id', 'stop_id', 'instructions'];
    
    public function tours()
    {
        return $this->belongsToMany('App\Models\Tour', 'route_tour');
    }
}
