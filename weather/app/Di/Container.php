<?php
namespace App\Di;
class Container
{
    /**
     * Summary of instance
     * @var 
     */
    private static  $instance;
    /**
     * Summary of dependencies
     * @var array
     */
    private array $dependencies = [];

    /**
     * @param array $dependencies
     */
    private function __construct(array $dependencies = [])
    {
        $this->dependencies = $dependencies;
    }
    /**
     * Undocumented function
     *
     * @return void
     */
    private function __clone(){}
    /**
     * Undocumented function
     */
    private function __wakeup(){}

    /**
     * @param array $dependencies
     * @return Container
     */
    public static function instance(array $dependencies = []): Container
    {
        if (self::$instance === null) self::$instance = new self($dependencies);
        return self::$instance;
    }

    /**
     * @param string $id
     * @return bool
     */
    public function has(string $id): bool
    {
        return isset($this->dependencies[$id]);
    }

    /**
     * @param string $id
     * @return string
     * @throws \Exception
     */
    public function get(string $id): string
    {
        if ($this->has($id)) {
            return $this->resolve($id);
        }else{
            throw new \Exception("Dependencies {$id} not found}");
        }
    }

    /**
     * @param string $id
     * @return string
     */

    private function resolve(string $id): string
    {
        return call_user_func($this->dependencies[$id], $this);
    }


}
