<?php
/**
 * Created by PhpStorm.
 * User: mircealucaciu
 */

namespace MiniDBMS\Utils;


interface Coder
{
    public function encode( $string);
    public function decode($string);
}