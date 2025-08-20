<?php
use App\Db\WeatherYandexTable;
use App\Di\Container;
use App\Handlers\UserRoleHandler;

Container::instance(
    [
        UserRoleHandler::class => function ($container) {
            global $USER;
        return  UserRoleHandler::checkValidationRole(WeatherYandexTable::class,$USER->GetID());
        },

]);



