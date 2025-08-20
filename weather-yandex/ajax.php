<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

if (!file_exists(__DIR__ . '/vendor/autoload.php')) return;
require __DIR__ . '/vendor/autoload.php';

use App\Request\RequestManager;
use Symfony\Component\Dotenv\Dotenv;
class WeatherRequestManager extends \Bitrix\Main\Engine\Controller
{
    /**
     * @return array[]
     */
    public function configureActions(): array
    {
        return [
            'getWeather' => [
                'prefilters' => [],
            ],
        ];
    }
    /**
     * @return array
     */
    public function getWeatherAction(): array
    {
        $pateEnv = __DIR__ . '/.env';
        if (file_exists($pateEnv)) (new DotEnv())->load($pateEnv);
        $url = $_ENV['API_YANDEX']."?lat=55.7558&lon=37.6173";
        $key = $_ENV['API_YANDEX_KEY'];
        $keyName = $_ENV['API_YANDEX_KEY_NAME'];
        $request = new RequestManager();
        $request->set($url,$keyName ,$key);
        $weatherInfo = $request->get();
        $fact =  $weatherInfo['fact'];
        $strClen = explode("/", $weatherInfo['info']['tzinfo']['name']);
         $city = array_pop($strClen);
        $time =  date("H:i:s",  $fact['obs_time']);
        $data  = date("d.m.Y",  $fact['obs_time']);

        return [
            'time' => $time,
            'city' =>$city,
            'temp' => $fact['temp'],
            'data' => $data,
            'feels' => $fact['feels_like'],
            'humidity' => $fact['humidity'],
            'wind' => $fact['wind_speed'],
            'icon' => $fact['icon']
        ];
    }
    /**
     * @param array $data
     * @return true[]
     */
    public function getOptionSaveAction(array $data): array
    {
      $switch = array_shift($data);
      $group = implode('|', array_unique($data));
      $table = App\Db\WeatherYandexTable::class;
        $check = $table::getRow([
            'select' => ['*'],
            'limit' => 1,
        ]);
        if (empty($check)) {
            $table::add([
                "SWITCH" => $switch,
                "GROUPS" => $group,
            ]);
            return ["success" => true];
        }
        $id = (int)$check['ID'];
        $table::update($id,
            [
            "SWITCH" => $switch,
            "GROUPS" => $group,
        ]);

        return ["success" => true];
    }
    /**
     * @return array
     */
    public function getUserGroupsAction(): array
    {
        $groups = \Bitrix\Main\GroupTable::getList([]);
        $arrGroups = [];
        while ($group = $groups->fetch()) {
            $arrGroups[]= [
                "sort"=>$group["C_SORT"],
                "name"=>$group['NAME'],
                "DESCRIPTION"=>$group['DESCRIPTION']
            ];
        }
       return  $arrGroups??[];
    }

}