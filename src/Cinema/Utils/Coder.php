<?php
/**
 * Created by PhpStorm.
 * User: mircealucaciu
 * Date: 27.04.2017
 * Time: 15:10
 */

namespace Cinema\Utils;


interface Coder
{
    public function encode( $string);
    public function decode($string);
}