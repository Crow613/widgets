<?php
namespace App\Request\DTO\Factory;
use App\Request\DTO\WeatherDTO;
use App\Request\DTO\Factory\WeatherDTOFactoryInterface;
use Bitrix\Main\Messenger\Internals\Exception\RuntimeException;

final class OpenMeteoWeatherDTOFactory implements WeatherDTOFactoryInterface
{
    /**
     * Summary of create
     * @param array $rawData
     * @throws \RuntimeException
     * @return WeatherDTO
     */
    public function create(array $rowData): WeatherDTO
    {
        
        if (empty($rowData['current_weather'])) {
            throw new \RuntimeException('OpenMeteo: invalid API response');
        }
        $current = $rowData['current_weather'];
        $rowTimestamp = explode("T",$current['time']);
        $city = $rowData['city_ip'];
        $data = array_pop($rowTimestamp);
        $time = array_pop($rowTimestamp);

        return new WeatherDTO(
            city: $city,
            temperature: (float) $current['temperature'],
            feelsLike: (float) $current['temperature'],
            humidity: 0.0, 
            windSpeed: (float) $current['windspeed'],
            weatherIcon: (string) $current['weathercode'],
            time: (string) $time,
            data: (string) $data
        );
    }
}



