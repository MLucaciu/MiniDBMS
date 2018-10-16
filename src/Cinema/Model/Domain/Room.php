<?php
/**
 * Created by PhpStorm.
 * User: mircealucaciu
 * Date: 26.04.2017
 * Time: 13:32
 */

namespace Cinema\Model\Domain;


class Room
{
    /**
     * @string
     */
    private $name;
    /**
     * @int
     */
    private $capacity;

    /**
     * Room constructor.
     * @param $name
     * @param $capacity
     */
    public function __construct($name, $capacity)
    {
        $this->name = $name;
        $this->capacity = $capacity;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getCapacity()
    {
        return $this->capacity;
    }




}