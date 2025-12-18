<?php 

namespace App\Services;

use App\Request\DTO\Factory\OpenMeteoWeatherDTOFactory;
use App\Request\RequestManager;
use App\Services\Helpers\ApiServiceHelper;

class MeteoApiService extends ApiServiceHelper{

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
     * Summary of city
     * @var string
     */
    protected string $city = 'Moscov';
  
    public function __construct()
    {
        parent::__construct(new OpenMeteoWeatherDTOFactory());
    }
    /**
     * Summary of request
     * @return void
     */
    protected function request(): void
    {
        $url = sprintf(
        $_ENV['API_OPEN_METEO']."?latitude=%s&longitude=%s&current_weather=true",
        $this->latitude,  $this->longitude);

        $request = new RequestManager();
        $request->set($url);
        $this->rowData = $request->get()??[];   
     }
}