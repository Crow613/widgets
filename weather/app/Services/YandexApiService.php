<?php
namespace App\Services;

use App\Request\RequestManager;
use App\Services\Helpers\ApiServiceHelper;
use App\Request\DTO\Factory\YandexWeatherDTOFectory;

class YandexApiService extends ApiServiceHelper
{
    /**
     * Summary of latitude
     * @var string
     */
    protected string $latitude = '55.7558';
    /**
     * Undocumented variable
     *
     * @var string
     */
    protected string $longitude = '37.6173';
     /**
     * Undocumented variable
     *
     * @var string
     */
    protected string $city = 'Moscov';

    public function __construct()
    {
        parent::__construct(new YandexWeatherDTOFectory());
    }
    /**
     * Summary of request
     * @return void
     */
    protected function request(): void
    {
        $key = $_ENV['API_YANDEX_KEY'];
        $keyName = $_ENV['API_YANDEX_KEY_NAME'];
        $url = sprintf($_ENV['API_YANDEX']."?lat=%s&lon=%s",$this->latitude, $this->longitude);
        $request = new RequestManager();

        $request->set($url, $keyName ,$key);
        $this->rowData = $request->get();
    }

}