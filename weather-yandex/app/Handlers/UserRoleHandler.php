<?php

namespace App\Handlers;

class UserRoleHandler
{
    /**
     * @param int $userId
     * @return array|null
     */
    public static function getUserGroupById(int $userId): array|null
    {
        if (!$userId || $userId <= 0) return null;
        return \CUser::GetUserGroup($userId);
    }

    /**
     * @param string $table
     * @param int $userId
     * @return bool
     */
    public static function checkValidationRole(string $table, int $userId): bool
    {
        $params = $table::getRow(['select' => ["SWITCH", "GROUPS"], 'limit' => 1]);

        $arGroups = self::getUserGroupById($userId);

        $switch = $params['SWITCH'] !== "Y" ? false : true;
        $groups = explode("|", $params["GROUPS"]);
        $userGroupParams= array_merge([1], $groups);

        $result_intersect = array_intersect($userGroupParams, $arGroups);

        $groups === 'N' ?? $result_intersect = false;

        return !empty($result_intersect) && $switch ?? false;
    }

}