<?php

/*
Стратегия - в случае, если у нас есть несколько вариантов (алгоритмов) обработки одной и той же операции в зависимости от заданных параметров.
1. интерфейс, который будет имплементироваться каждому классу варианту оплаты
2. два класса с разными параметрами но одинаковой обработкой
3. создать основной класс, в котором будет определяться вариант использования той или иной стратегии посредством проверки определенного условия в методе этог класса
*/

interface payStrategy {
    public function pay($amount);
}

class payByCC implements payStrategy {

    private $ccNum = '';
    private $ccType = '';
    private $cvvNum = '';
    private $ccExpMonth = '';
    private $ccExpYear = '';

    public function pay($amount = 0) {
        echo "Paying ". $amount. " using Credit Card";
    }

}

class payByPayPal implements payStrategy {

    private $payPalEmail = '';

    public function pay($amount = 0) {
        echo "Paying ". $amount. " using PayPal";
    }

}

class shoppingCart {

    public $amount = 0;

    public function __construct($amount = 0) {
        $this->amount = $amount;
    }

    public function getAmount() {
        return $this->amount;
    }

    public function setAmount($amount = 0) {
        $this->amount = $amount;
    }

    public function payAmount() {
        if($this->amount >= 500) {
            $payment = new payByCC();
        } else {
            $payment = new payByPayPal();
        }

        $payment->pay($this->amount);
    }
}

$cart = new shoppingCart(499);
$cart->payAmount();

// Вывод
Paying 499 using PayPal

$cart = new shoppingCart(501);
$cart->payAmount();

//Вывод
Paying 501 using Credit Card

