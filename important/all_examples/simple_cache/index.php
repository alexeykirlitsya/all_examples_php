<?php

require_once 'rb.php';
require_once 'Cache.php';

$db = [
    'dsn' => 'mysql:host=localhost; dbname=mvc;charset=utf8',
    'user' => 'root',
    'pass' => ''
];

\R::setup($db['dsn'],$db['user'],$db['pass']);


\R::fancyDebug();

$posts = (new Cache())->get('posts123');
if (!$posts){
    $posts = \R::findAll('posts');
    (new Cache())->set('posts123', $posts);
}

$categories = (new Cache())->get('categories123');
if (!$categories){
    $categories = \R::findAll('category');
    (new Cache())->set('categories123', $categories);
}

$posts_culinary_blog = (new Cache())->get('p_c_b');
if (!$posts_culinary_blog){
    $posts_culinary_blog = \R::findAll('posts_culinary_blog');
    (new Cache())->set('p_c_b', $posts_culinary_blog);
}


foreach ($posts as $post){
    print_r($post->title.'<br>');
}
echo "<hr>";
foreach ($categories as $category){
    print_r($category->title.'<br>');
}
echo "<hr>";
foreach ($posts_culinary_blog as $c){
    print_r($c->title.'<br>');
}

//(new Cache())->delete('p_c_b');