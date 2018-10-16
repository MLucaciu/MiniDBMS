<?php
/**
 * Created by PhpStorm.
 * User: mircealucaciu
 * Date: 27.04.2017
 * Time: 15:11
 */

namespace Cinema\Utils;


class JsonCoder implements Coder
{
    public function encode($string)
    {
        return json_encode($string);
    }

    public function decode($string)
    {
        return json_decode($string,true);
    }

}