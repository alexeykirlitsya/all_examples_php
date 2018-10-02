<?php

/*
Декоратор - динамическое подключение к объекту дополнительного функционала.
1.интерфейс, который обязывает класс реализовать требуемые методы
2.основной класс
3. абстрактный класс декоратора
4. два подкласса основного декоратора, которые и реализуют изменение поведения основного класса
*/

// интерфейс, который обязывает класс реализовать требуемые методы
interface eMailBody {
    public function loadBody();
}

// основной класс
class eMail implements eMailBody {
    public function loadBody() {
        echo "This is Main Email body.<br>";
    }
}

// класс декоратора
abstract class emailBodyDecorator implements eMailBody {

    protected $emailBody;

    public function __construct(eMailBody $emailBody) {
        $this->emailBody = $emailBody;
    }

    abstract public function loadBody();

}

// два подкласса основного декоратора, которые и реализуют изменение поведения основного класса 
class christmasEmailBody extends emailBodyDecorator {

    public function loadBody() {

        echo 'This is Extra Content for Christmas<br>';
        $this->emailBody->loadBody();

    }

}

class newYearEmailBody extends emailBodyDecorator {

    public function loadBody() {

        echo 'This is Extra Content for New Year.<br>';
        $this->emailBody->loadBody();

    }

}


/*
 *  Обычное письмо
 */

$email = new eMail();
$email->loadBody();

// Вывод
This is Main Email body.


/*
 *  Письмо с поздравлениями с Рождеством
 */

$email = new eMail();
$email = new christmasEmailBody($email);
$email->loadBody();

// Вывод
This is Extra Content for Christmas
This is Main Email body.

/*
 *  Письмо с поздравлениями к Новому Году
 */

$email = new eMail();
$email = new newYearEmailBody($email);
$email->loadBody();


// Вывод
This is Extra Content for New Year.
This is Main Email body.

/*
 *  Письмо с поздравлениями с Рождеством и Новым Годом
 */

$email = new eMail();
$email = new christmasEmailBody($email);
$email = new newYearEmailBody($email);
$email->loadBody();

// Output
This is Extra Content for New Year.
This is Extra Content for Christmas
This is Main Email body.
