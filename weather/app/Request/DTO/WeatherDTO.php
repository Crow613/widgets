<?php
namespace App\Request\DTO;
final class WeatherDTO
{
    public function __construct(
        public readonly string $city,
        public readonly float $temperature,
        public readonly float $feelsLike,
        public readonly float $humidity,
        public readonly float $windSpeed,
        public readonly string $weatherIcon,
        public readonly string $time,
        public readonly string $data
    ) {}

}