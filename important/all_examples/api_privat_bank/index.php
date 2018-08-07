<?php

$a = 'https://api.privatbank.ua/p24api/pubinfo?json&exchange&coursid=5';

$data =  file_get_contents($a);
$courses = json_decode($data, true);
echo "<pre>";
print_r($courses);


foreach ($courses as $course){
    if($course['ccy'] == 'USD'){
        $course_curr = $course['buy'];
        break;
    }
}
echo "<hr>";
echo $course_curr;