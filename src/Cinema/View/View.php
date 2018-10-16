<?php
/**
 * Created by PhpStorm.
 * User: mircealucaciu
 * Date: 28.04.2017
 * Time: 14:07
 */

namespace Cinema\View;


class View
{

    /**
     * View constructor.
     */
    public function __construct()
    {
    }

    /**
     * @param $result
     */
    public function showResult($result){
       echo $result;
    }
}