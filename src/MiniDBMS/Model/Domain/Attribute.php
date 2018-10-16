<?php
/**
 * Created by PhpStorm.
 * User: Mircea
 * Date: 10/16/2018
 * Time: 7:33 PM
 */

namespace MiniDBMS\Model\Domain;


class Attribute
{
    /** @var string  */
    private $attributeName;
    /** @var string  */
    private $type;
    /** @var string  */
    private $length;
    /** @var string  */
    private $isNull;

    /**
     * Attribute constructor.
     * @param $attributeName
     * @param $type
     * @param $length
     * @param $isNull
     */
    public function __construct(string $attributeName,string $type,string $length,string $isNull)
    {
        $this->attributeName = $attributeName;
        $this->type = $type;
        $this->length = $length;
        $this->isNull = $isNull;
    }

    /**
     * @return mixed
     */
    public function getAttributeName()
    {
        return $this->attributeName;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return mixed
     */
    public function getLength()
    {
        return $this->length;
    }

    /**
     * @return mixed
     */
    public function getisNull()
    {
        return $this->isNull;
    }

}