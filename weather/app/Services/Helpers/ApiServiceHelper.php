<?php

declare(strict_types=1);


namespace App\Services\Helpers;

use App\Request\DTO\WeatherDTO;
use App\Services\ApiServiceInterface;
use App\Request\DTO\Factory\WeatherDTOFactoryInterface;

abstract class ApiServiceHelper implements ApiServiceInterface
{
    /**
     * Summary of latitude
     * @var string
     */
    protected string $latitude;
    /**
     * Undocumented variable
     *
     * @var string
     */
    protected string $longitude;
     /**
      * Summary of rawData
      * @var array
      */
      protected string $city;
     protected array $rawData = [];
   /**
    * Summary of __construct
    * @param WeatherDTOFactoryInterface $dtoFactory
    */
   protected WeatherDTOFactoryInterface $dtoFactory;
   public function __construct( WeatherDTOFactoryInterface $dtoFactory )
   {
      $this->dtoFactory = $dtoFactory;
   }
   /**
    * Summary of set
    * @param string $latitude
    * @param string $longitude
    * @param string $city
    * @return void
    */
   public function set(string $latitude = '', string $longitude = '', string $city = ""): void
   {
        if(!empty($city)){
            $this->city = $city;
        }
        if(!empty($latitude)){
            $this->latitude = $latitude;
        }
        if(!empty($longitude)){
            $this->longitude = $longitude;
        }
   }
   /**
    * 
   
    * @return WeatherDTO
    */
   public function get(): WeatherDTO
   {
        $this->request();
        $this->rowData['city_ip'] .= $this->city;
        return $this->dtoFactory->create($this->rowData);
   }
  /**
   * Summary of loadWeather
   * @param ApiServiceInterface $service
   * @return WeatherDTO
   */
  public function loadWeather(ApiServiceInterface $service): WeatherDTO  
  {
    $service->set('55.75', '37.61',"");
    return $service->get();
  }
  abstract protected function request(): void;   
}