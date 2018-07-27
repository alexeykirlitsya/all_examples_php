<?php
/*
 * Реестр
 * Основное применение реестра – в качестве безопасной замены глобальным переменным.
 */

class Registry
{
    protected static $data = [];

    public static function set($key, $value)
    {
        self::$data[$key] = $value;
    }

    public static function get($key)
    {
        return isset(self::$data[$key]) ? self::$data[$key] : null;
    }

    final public static function removeRegistry($key)
    {
        if (array_key_exists($key, self::$data)) {
            unset(self::$data[$key]);
        }
    }
}

Registry::set('name_1', 'First registry');
Registry::set('name_2', 'Second registry');

print_r(Registry::get('name_1'));
print_r(Registry::get('name_2'));

Registry::removeRegistry('name_1');
Registry::removeRegistry('name_2');