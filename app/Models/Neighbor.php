<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Neighbor extends Model
{
    protected $primaryKey = 'neighbor_id';
    use HasFactory;

    public function property()
    {
        return $this->belongsTo(Property::class,'property_id','property_id');
    }
}
