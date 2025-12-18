<?php
use App\Db\WeatherTable;
use App\Di\Container;
use App\Handlers\UserRoleHandler;

Container::instance(
    [
        UserRoleHandler::class => function ($container) {
            global $USER;
            return  UserRoleHandler::checkValidationRole(WeatherTable::class,$USER->GetID());
        },
]);



