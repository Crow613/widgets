<?php
namespace App\Request\DTO\Factory;
use App\Request\DTO\WeatherDTO;
use App\Request\DTO\Factory\WeatherDTOFactoryInterface;
use Bitrix\Main\Messenger\Internals\Exception\RuntimeException;

final class YandexWeatherDTOFectory implements WeatherDTOFactoryInterface
{
    public function create(array $rowData): WeatherDTO
    {
        
        if(!isset($rowData['fact'])){
           throw new RuntimeException('Yandex: invalid API response');
        }
        $fact = $rowData['fact'];
        $city = $rowData['city_ip'] ;
        $time =  date("H:i:s",  $fact['obs_time']);
        $data  = date("d.m.Y",  $fact['obs_time']);
        
        return new WeatherDTO( 
            (string)$city,
            (float)$fact['temp'],
            (float)$fact['feels_like'],
            (float)$fact['humidity'],
            (float)$fact['wind_speed'],
            (string)$fact['icon'],
            $time,
            $data,
        );
    }
}