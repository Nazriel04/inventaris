<?php

namespace App\Repositories;

use App\CommodityCondition;

class CommodityConditionRepository
{
    public function __construct(
        private CommodityCondition $model
    ) {}

    public function getAll()
    {
        return $this->model->latest()->get();
    }
}