<?php

namespace App\Handlers;
class GeoOptionHandler
{
    /**
     * Summary of getIp
     */
    public function getIp()
    {
        $result = $_SERVER['HTTP_CF_CONNECTING_IP'] ?? $_SERVER['HTTP_X_FORWARDED_FOR'] ?? $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1';

        if (strpos($result, ',') !== false)  $result = trim(explode(',', $result)[0]);
        if ($result === '127.0.0.1' ||  preg_match('#^(192\.168|10\.|172\.(1[6-9]|2\d|3[0-1]))#', $result)) {
            $result = [
                'country' => 'AM',
                'region' => 'Yerevan',
                'city' => 'Yerevan',
                'latitude' => 40.1872,
                'longitude' => 44.5152,
            ];
        } 
        return $result;
    }
    /**
     * Summary of getGeoData
     * @return array|array{city: mixed, country: mixed, latitude: mixed, longitude: mixed}
     */
    public function getGeoData(): array
    {
        $geoData = $this->getIp();
        if(!is_array($geoData)){
            $ip = $geoData;
            $geo = \Bitrix\Main\Service\GeoIp\Manager::class;
            $geoData = [
                'country' => $geo::getCountryName($ip,"en"),
                'city'    => $geo::getCityName($ip,"en"),
                'latitude' => $geo::getGeoPosition($ip)['latitude'],
                'longitude' => $geo::getGeoPosition($ip)['longitude'],
            ];
        }
        return $geoData;
    }
}