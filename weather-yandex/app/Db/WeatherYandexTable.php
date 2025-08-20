<?php

namespace App\Db;

use Bitrix\Main\Entity;
use Bitrix\Main\Localization\Loc;

class WeatherYandexTable extends Entity\DataManager
{
    /**
     * @return string
     */
    public static function getTableName(): string
    {
        return 'cs_weather_yandex';
    }

    /**
     * @return array
     */
    public static function getMap(): array
    {
        return [
            new Entity\IntegerField('ID', [
                'primary' => true,
                'autocomplete' => true,
                'autocomplete_title' => Loc::getMessage('ID'),
                'autocomplete_type' => 'integer',
                'title' => Loc::getMessage('ID'),
            ]),
            new Entity\StringField('SWITCH', [
                'required' => true,
                'defaultValue' => 'N',
            ]),
            new Entity\StringField('GROUPS', [
                'required' => true,
            ]),
            new Entity\DatetimeField('DATE_CREATE', [
                'default_value' => function() {
                    return new \Bitrix\Main\Type\DateTime();
                },
            ]),
        ];
    }

    /**
     * @return void
     */
    public static function createTable(): void
    {
        $connection = \Bitrix\Main\Application::getConnection();
        if (!$connection->isTableExists(self::getTableName())) {
                $connection->createTable(
                    self::getTableName(),
                    self::getEntity()->getFields()
                );
        }
    }

    /**
     * @return void
     */
    public static function dropTable(): void
    {
        $connection = \Bitrix\Main\Application::getConnection();
        if ($connection->isTableExists(self::getTableName()))
        {
            $connection->dropTable(self::getTableName());
        }
    }
}

