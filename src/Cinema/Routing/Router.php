<?php
/**
 * Created by PhpStorm.
 * User: mircealucaciu
 * Date: 27.04.2017
 * Time: 08:10
 */

namespace Cinema\Routing;


class Router
{
    private $controller;
    private $contents;
    private $method;

    /**
     * Router constructor.
     * @param $controller
     * @param $contents
     * @param $method
     */
    public function __construct($controller, $contents, $method)
    {
        $this->controller = $controller;
        $this->contents = $contents;
        $this->method = $method;
    }

    /**
     * @return mixed
     */
    public function getController()
    {
        return $this->controller;
    }

    /**
     * @return mixed
     */
    public function getContents()
    {
        return $this->contents;
    }

    /**
     * @return mixed
     */
    public function getMethod()
    {
        return $this->method;
    }




}