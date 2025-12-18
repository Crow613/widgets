<?php

declare(strict_types=1);

namespace App\Services\Factory;

use InvalidArgumentException;
use App\Services\MeteoApiService;
use App\Services\YandexApiService;
use App\Services\ApiServiceInterface;

final class ApiServiceFactory
{
    /**
     * Summary of create
     * @param string $driver
     * @return MeteoApiService|YandexApiService
     */
    public static function create(string $driver): ApiServiceInterface
    {
        return match($driver){
            "meteo" => new MeteoApiService(),
            "yandex" => new YandexApiService(),
            default => throw new InvalidArgumentException('Unknown API driver')
        };
    }
}
