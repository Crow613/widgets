<?php

namespace App\Handlers;

class GeoStorageHandler
{
   public function  saveGeoConfig(array $geoData)
   {

    $localStorage = \Bitrix\Main\Application::getInstance()->getLocalSession('weather_geo_data');
    if (!isset($localStorage['weather_geo_data']))
    {
        $localStorage->set('productIds', [1, 2, 100]);
    }
    var_dump($localStorage->get('productIds'));
   }
}
