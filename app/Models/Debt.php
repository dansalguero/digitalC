<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Debt extends Model
{

    protected $primaryKey = 'debt_id';
    protected $fillable = [
        'property_id',
        'community_id',
        'debt_description',
        'issue_date',
        'maturity_date',
        'amount',
        'debt_type_id',
        'neighbor_id',
        'status_id'
        // Agrega aquí otros campos que también sean fillable
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
