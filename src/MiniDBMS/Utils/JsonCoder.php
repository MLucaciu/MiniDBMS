<?php
/**
 * Created by PhpStorm.
 * User: mircealucaciu
 */

namespace MiniDBMS\Utils;


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