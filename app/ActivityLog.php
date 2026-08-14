<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    protected $fillable = [
        'commodity_id',
        'activity',
        'description',
        'user_name',
    ];

    public function commodity()
    {
        return $this->belongsTo(Commodity::class);
    }
}
