<?php
/**
 * Created by PhpStorm.
 * User: philippe
 * Date: 31/03/16
 * Time: 15:01
 */

namespace Wiidoo\Support;

use Illuminate\Support\Facades\Config;

class Treatments
{
    const IS_PUBLIC = false;

    const IS_PUBLIC_AND_PROTECTED = true;

    public $classCall;

    public $config;

    public function __construct()
    {
        $this->classCall = get_called_class();
    }

    /**
     * @param $name
     */
    protected function mergeConfig($name)
    {
        if (Config::get($name)) {
            $config = Config::get($name);

            foreach ($config as $key => $value) {
                if ($this->validatePropertyChange($key, true)) {
                    $this->$key = $value;
                }
            }
        }
    }

    /**
     * @param $name
     * @param bool $protected
     * @return bool
     */
    protected function validatePropertyChange($name, $protected = false)
    {
        if (property_exists($this->classCall, $name)) {

            $property = new \ReflectionClass($this->classCall);
            $property = $property->getProperty($name);

            return $property->isPublic() ? true : ($protected ? $property->isProtected() : false);
        }

        return false;
    }

}