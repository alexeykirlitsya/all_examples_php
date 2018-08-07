<?php

sleep(1);

//$js = json_decode($_POST);
//print_r(json_encode($_POST));

//print_r($_POST) ;
$name = $_POST['name'];
$age = $_POST['age'];

echo 'My name is '.$name.'. I am '.$age.' years old!';