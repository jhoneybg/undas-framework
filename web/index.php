<?php

$loader = require __DIR__.'/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Aplication;

//Grabing Request
$request = Request::createFromGlobals();

//Bootstraping
$app = new Aplication(array('database' => array('host' => 'localhost')));

//Route Register
$app->route('/hello/{name}',function($name) {
    return new Response(sprintf('Hello %s', $name));
});

//Request handling
$response = $app->handle($request);

//Send Response
$response->send();