<?php
namespace App\Request;

use Bitrix\Main\Web\HttpClient;
class RequestManager
{
    public string $url = '';
    private string $apiKey =  '';
    private string $apiKeyName = '';

    /**
     * @param string $url
     * @param string $keyName
     * @param string $key
     * @return void
     */
    public function set(string $url,string $keyName='', string $key=''): void
    {
        $this->url = $url;
        $this->apiKey = $key ;
        $this->apiKeyName = $keyName ;
    }
    /**
     * @return array
     */
    public function get(): array
    {
        return $this->httpClient();
    }

    /**
     * @return array
     */
    private function httpClient(): array
    {
        $httpClient = new HttpClient();
        if(!empty($this->apiKeyName) || !empty($this->apiKey) ){
            $httpClient->setHeader($this->apiKeyName, $this->apiKey);
        }
        $httpClient->setHeader('Content-Type', 'application/json');
        return json_decode($httpClient->get($this->url),true) ?? [];
    }

}