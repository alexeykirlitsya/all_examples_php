<?php

/*
 * Одиночка
 * Обеспечивает существование только одного экземпляра класса
 */

class Singleton
{
    private static $_instance  = null;

    public static function getInstance()
    {
        if (self::$_instance === null){
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    private function __clone() {}

    private function __construct() {}

    private function __wakeup() {}

    private function __sleep() {}

}

$a = Singleton::getInstance();
$a = Singleton::getInstance();
$a = Singleton::getInstance();