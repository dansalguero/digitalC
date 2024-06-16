<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    protected $primaryKey = 'property_id';
    use HasFactory;

    public function status()
    {
        return $this->belongsTo(Property_status::class, 'status_id');
    }

    public function neighbor()
    {
        return $this->belongsTo(Neighbor::class, 'property_id', 'property_id');
    }

    public function community()
    {
        return $this->belongsTo(Community::class, 'community_id', 'community_id');
    }
}
