<?php

namespace App\Http\Controllers;
use App\Handlers\GeoOptionHandler;
use App\Services\Factory\ApiServiceFactory;

class WeatherController
{
    /**
     * Summary of getWeather
     * @param string $service
     * @param string $latitude
     * @param string $longitude
     * @param string $city
     * @return array{
     * city: string|int, 
     * data: string|int,
     * feels: string|int, 
     * humidity: string|int, 
     * icon: string|int, 
     * temp: string|int, 
     * time: string|int, 
     * wind: string|int
     * }
     */
    public function getWeather(
        string $service = "meteo", 
        string $latitude = "", 
        string $longitude = "", 
        string $city = "" 
        ): array
    {
        if(empty($latitude) && empty($longitude)){
           $geoDataInIp = (new GeoOptionHandler())->getGeoData();
           $latitude = $geoDataInIp['latitude'];
           $longitude = $geoDataInIp['longitude'];
           $city = $geoDataInIp['city'];
        }
        $factoryService =  ApiServiceFactory::create($service);
        $factoryService->set($latitude, $longitude, $city);
        $data = $factoryService->get();

        return [
            'time' => $data->time,
            'city' =>$data->city,
            'temp' => $data->temperature,
            'data' => $data->data,
            'feels' => $data->feelsLike,
            'humidity' => $data->humidity,
            'wind' => $data->windSpeed,
            'icon' => $data->weatherIcon
        ];
    }
}