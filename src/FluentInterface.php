<?php
/**
 * Created by PhpStorm.
 * User: philippe
 * Date: 31/03/16
 * Time: 14:25
 */

namespace Wiidoo\Support;


class FluentInterface extends Treatments
{

    public function __call($name, $arguments)
    {
        if ($this->validatePropertyChange($name)) {
            if (isset($arguments[0])) {
                $this->$name = $arguments[0];
            } elseif (is_bool($this->$name)) {
                $this->$name = !$this->searchNegatedName($name, true);
            }

        } elseif ($negatedName = $this->searchNegatedName($name)) {
            $this->$negatedName = false;
        }

        return $this;
    }

    /**
     * @param $name
     * @param bool $returnBool
     * @return bool|string
     */
    protected function searchNegatedName($name, $returnBool = false)
    {
        $prefixes = ['no', 'not', 'disable'];

        do {
            $prefix = current($prefixes);

            if (strripos($name, $prefix) === 0) {
                if ($returnBool) {
                    return true;
                }

                $realName = lcfirst(str_replace($prefix, '', $name));

                if (property_exists($this->classCall, $realName)) {
                    return $realName;
                }
            }

        } while (next($prefixes));

        return false;
    }

}