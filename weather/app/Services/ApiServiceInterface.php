<?php

declare(strict_types=1);

namespace App\Services;

use App\Request\DTO\WeatherDTO;

interface ApiServiceInterface
{
    /**
     * Summary of set
     * @param string $latitude
     * @param string $longitude
     * @param string $city
     * @return void
     */
    public function set(string $latitude, string $longitude, string $city): void;
    public function get(): WeatherDTO;
}
