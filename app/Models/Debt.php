<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Debt extends Model
{

    protected $primaryKey = 'debt_id';

    //Para inserción masiva
    protected $fillable = [
        'property_id',
        'community_id',
        'debt_description',
        'issue_date',
        'maturity_date',
        'amount',
        'neighbor_id',
        'status_id'
    ];
    public function property()
    {
        return $this->belongsTo(Property::class, 'property_id', 'property_id');
    }

    public function neighbor()
    {
        return $this->belongsTo(Neighbor::class, 'neighbor_id', 'neighbor_id');
    }
    use HasFactory;
}
