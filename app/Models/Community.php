<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Community extends Model
{
    protected $primaryKey = 'community_id';
    public function owner()
    {

        return $this->belongsTo(User::class, 'user_id');

    }

    public function properties()
    {
        return $this->hasMany(Property::class, 'community_id', 'community_id');
    }
    use HasFactory;

    public function neighbors()
    {
        return $this->hasMany(Neighbor::class, 'community_id', 'community_id');
    }

    public function debts()
    {
        return $this->hasMany(Debt::class, 'community_id', 'community_id');
    }
}

