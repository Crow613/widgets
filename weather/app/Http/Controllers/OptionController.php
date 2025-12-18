<?php

namespace App\Http\Controllers;

use App\Http\Models\Group;
use App\Http\Models\WeatherOptions;

class OptionController
{
    /**
     * Summary of saveOption
     * @param string $switch
     * @param string $group
     * @return array{success: bool}
     */
    public function saveOption(string $switch, string $group): array
    {
  
        $table = new WeatherOptions();
        $id = $table->getoptions();
        if (empty($id)) 
          return  $table->createOptions($switch, $group) ? ["success" => true] : ["success" => false];
        $id = (int)$id;
         return $table->updateOptions($id, $switch, $group) ? ["success" => true] : ["success" => false];
    }
    /**
     * Summary of getUserGroupsAction
     * @return array
     */
    public function getUserGroupsAction(): array
    {
       $grops =  new Group();
       return  $grops->getUserGroup() ?? [];
    }
}