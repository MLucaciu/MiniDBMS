<?php
/**
 * Created by PhpStorm.
 * User: mircealucaciu
 */

ini_set('display_errors', 1);
require_once 'vendor/autoload.php';
use Cinema\Routing\Route;
use Cinema\Utils\JsonCoder;
use Cinema\View\View;

//creating Route object to determine the route
try {
    $route = new Route();

    //get the body from the request
    $contents = file_get_contents('php://input');

    //decode  the data
    $coder = new JsonCoder();
    if (!empty($contents)) {

        $contents = $coder->decode($contents);
    }

    //returns and Router object
    $router = $route->getRoute($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI'], $contents);

    //name of the controller
    $controller = $router->getController();

    //the parameters
    $body = $router->getContents();

    //the method name
    $method = $router->getMethod();

    //path to the controller
    $path = 'Cinema\\Controller\\' . $controller;
    // $repo='Cinema\\Model\\Repository' .

    //instantiating the controller
    $service = new $path();

    //calling the controller method
    $result = $service->$method($body);

    $result = $coder->encode($result);

    $view = new View();
    $view->showResult($result);

    //set header
    header('HTTP/1.1 200 OK', true, 200);
} catch(PDOException $e){
    header('HTTP/1.1 400 Bad Request', true, 400);
} catch(Exception $e){
    header('HTTP/1.1 400 Bad Request', true, 400);
}

