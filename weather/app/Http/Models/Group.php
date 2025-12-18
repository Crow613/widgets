<?php

namespace App\Http\Models;

class Group
{
    /**
     * Summary of table
     * @var string
     */
    private string $table = \Bitrix\Main\GroupTable::class;
    /**
     * Summary of getUserGroup
     * @return array{DESCRIPTION: string, name: string, sort: mixed[]}
     */
    public function getUserGroup(): array
    { 
        $groups = $this->table::getList([]);
        $arrGroups = [];
        
        while ($group = $groups->fetch()) {
            $arrGroups[]= [
                "sort"=> $group["C_SORT"],
                "name"=> $group['NAME'],
                "DESCRIPTION"=> $group['DESCRIPTION']
            ];
        }
       return  $arrGroups ?? [];
    }

}