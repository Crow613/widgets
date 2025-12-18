<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
if (!file_exists(__DIR__ . '/vendor/autoload.php')) return;
require __DIR__ . '/vendor/autoload.php';

use App\Http\Controllers\WeatherController;
use App\Http\Controllers\OptionController;
use Symfony\Component\Dotenv\Dotenv;

class WeatherRequestManager extends \Bitrix\Main\Engine\Controller
{
    /**
     * @return array[]
     */
    public function configureActions(): array
    {
        return [ 'getWeather' => [ 'prefilters' => []  ] ];
    }
    /**
     * @return array
     */
    public function getWeatherAction(array &$data = []): array
    {
        $pateEnv = __DIR__ . '/.env';
        if (file_exists($pateEnv)) (new DotEnv())->load($pateEnv);
        return (new WeatherController())->getWeather();
    }
    /**
     * @param array $data
     * @return true[]
     */
    public function getOptionSaveAction(array &$data): array
    {
   
      $switch = array_shift($data);
      $group = implode('|', array_unique($data));
    
      $option =  new OptionController();
    

      $option->saveOption($switch, $group);
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
                "sort"=> $group["C_SORT"],
                "name"=> $group['NAME'],
            ];
        }
       return  $arrGroups ?? [];
    }
}