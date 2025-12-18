<?php
namespace App\Http\Models;
class WeatherOptions
{
    /**
     * Summary of table
     * @var string
     */
    private string $table = \App\Db\WeatherTable::class;
    /**
     * Summary of getoptions
     * @return int|false
     */
    public function getoptions(): int|false
    {
        return $this->table::getRow([ 'select' => ['ID'], 'limit' => 1 ])['ID'] ?? false;
    }
    /**
     * Summary of createOptions
     * @param string $switch
     * @param string $group
     * @return bool
     */
    public function createOptions(string $switch, string $group): bool
    {
        return  $this->table::add(["ID"=>1, "SWITCH" => $switch,  "GROUPS" => $group ]) ? true : false;
    }
    /**
     * Summary of updateOptions
     * @param int|string $id
     * @param string $switch
     * @param string $group
     * @return bool
     */
    public function updateOptions(int|string $id, string $switch, string $group): bool
    {
        return $this->table::update($id,[ "SWITCH" => $switch, "GROUPS" => $group ]) ? true : false;
    }
}