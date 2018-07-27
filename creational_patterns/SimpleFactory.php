<?php

/*
 * Простая фабрика
 * Генерирует экземпляр для клиента, не раскрывая никакой логики
 */

interface Window
{
    public function getWidth();
    public function getHeight();
}

class WoodWindow implements Window
{
    protected $width;
    protected $height;

    public function __construct($width, $height)
    {
        $this->width = $width;
        $this->height = $height;
    }

    public function getWidth(){
        return $this->width;
    }

    public function getHeight(){
        return $this->height;
    }
}

class WindowFactory
{
    public static function makeWindow($width, $height) : Window
    {
        return new WoodWindow($width, $height);
    }
}

$window = WindowFactory::makeWindow(120, 160);
echo 'Width: ' . $window->getWidth();
echo 'Height: ' . $window->getHeight();