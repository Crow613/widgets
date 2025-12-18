<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
if (!file_exists(__DIR__ . '/vendor/autoload.php')) return;

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/config/di.php';

use App\Handlers\UserRoleHandler;
use Bitrix\Main\Loader;
use Bitrix\Main\NotSupportedException;
use Symfony\Component\Dotenv\Dotenv;

class WeatherYandexManager extends CBitrixComponent
{
    /** @return void */
    public function executeComponent(): void
    {
        try {
            $engin = new  \CComponentEngine();
            $arUrlTemplates = ["stream" => "stream/"];
            $page = $engin->guessComponentPath("/",
            $arUrlTemplates,$arVariables);

            if(array_key_exists($page, $arUrlTemplates)){
                $this->init();
                $this->checkUserRole();
            }
            if (\Bitrix\Main\Engine\CurrentUser::get()->isAdmin()){

                $this->setTemplateName('menu_config');
                $this->includeComponentTemplate();
            }
            
        } catch (Exception $exception) {
            ShowError($exception->getMessage());
        }
    }
    /**
     * @return void
     * @throws NotSupportedException
     * @throws \Bitrix\Main\LoaderException
     */
    public function init(): void
    {
        $pateEnv = __DIR__ . '/.env';
        if (file_exists($pateEnv)) {
         (new DotEnv())->load($pateEnv);
        }
        $this->checkModules();
        $this->installTable();
    }

    /**
     * @return true
     */
    public function installTable()
    {
        \App\Db\WeatherTable::createTable();
        return true;
    }

    /**
     * @return void
     */
    private function checkUserRole(): void
    {
       $checkUserRoll = \App\Di\Container::instance()->get(UserRoleHandler::class);
        if ($checkUserRoll) {
            $this->includeComponentTemplate();
        }
    }
    /**
     * @return void
     * @throws \Bitrix\Main\NotSupportedException|\Bitrix\Main\LoaderException
     */
    private function checkModules(): void
    {
       if(!Loader::includeModule('crm')){
           throw new NotSupportedException('module CRM not installed');
       }
    }

}

