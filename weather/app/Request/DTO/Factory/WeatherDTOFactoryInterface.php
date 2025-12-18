<?php

namespace App\Request\DTO\Factory;

use App\Request\DTO\WeatherDTO;

interface WeatherDTOFactoryInterface
{
    public function create(array $rawData): WeatherDTO;
}
