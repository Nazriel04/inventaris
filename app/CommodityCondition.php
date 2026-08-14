<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommodityCondition extends Model
{
    protected $fillable = [
        'name',
        'badge_color',
    ];

    public function commodities()
    {
        return $this->hasMany(Commodity::class);
    }
}