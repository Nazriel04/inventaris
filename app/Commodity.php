<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commodity extends Model
{
    use HasFactory;

    protected $guarded = [];

   

    /**
     * Get the commodity location associated with the commodity.
     */
    public function commodity_location()
    {
        return $this->belongsTo(CommodityLocation::class);
    }

    /**
     * Get the commodity acquisition associated with the commodity.
     */
   
public function commodityCondition()
{
    return $this->belongsTo(CommodityCondition::class, 'commodity_condition_id');
}
    /**
     * Format a date value to Indonesian date format (dd-mm-yyyy).
     */
    public function indonesian_format_date($value)
    {
        return Carbon::parse($value)->format('d-m-Y');
    }

    /**
     * Format a currency value to Indonesian currency format.
     */
    public function indonesian_currency($value)
    {
        return number_format($amount, 2, ',', '.');
    }

    /**
     * Get the name of the condition based on the condition code.
     */
  public function getConditionName()
{
    return $this->commodityCondition?->name ?? 'Tidak Diketahui';
}
public function getConditionBadgeClass()
{
    return match ($this->getConditionName()) {
        'Baik' => 'success',
        'Kurang Baik' => 'warning',
        'Dalam Perbaikan' => 'info',
        'Rusak Berat' => 'danger',
        'Hilang' => 'dark',
        default => 'secondary',
    };
}
}