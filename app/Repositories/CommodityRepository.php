<?php

namespace App\Repositories;

use App\Commodity;

class CommodityRepository
{
    public function __construct(
        private Commodity $model
    ) {}

    /**
     * Count commodities based on different conditions.
     */
  public function countCommodityCondition()
{
    return $this->model
        ->selectRaw('commodity_condition_id, COUNT(*) AS count')
        ->with('commodityCondition')
        ->groupBy('commodity_condition_id')
        ->orderBy('commodity_condition_id', 'ASC')
        ->get();
}

    /**
     * Count commodities for each year of purchase.
     */
    public function countCommodityEachYear()
    {
        return $this->model->selectRaw('COUNT(`year_of_purchase`) AS count, year_of_purchase')
            ->groupBy('year_of_purchase')
            ->orderBy('year_of_purchase')
            ->get();
    }

    /**
     * Count the number of commodities grouped by material.
     */
    public function countCommodityByMaterial()
    {
        return $this->model->selectRaw('COUNT(`material`) AS count, material')
            ->groupBy('material')
            ->orderBy('material')
            ->get();
    }

    /**
     * Count the number of commodities grouped by brand.
     */
    public function countCommodityByBrand()
    {
        return $this->model->selectRaw('COUNT(`brand`) AS count, brand')
            ->groupBy('brand')
            ->orderBy('brand')
            ->get();
    }
}
