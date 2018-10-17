<?php
/**
 * Created by PhpStorm.
 * User: Mircea
 * Date: 10/16/2018
 * Time: 7:33 PM
 */

namespace MiniDBMS\Model\Domain;


class Database
{
    /** @var string  */
    private $name;
    /** @var array */
    private $structure;

    /**
     * Database constructor.
     * @param string $name
     * @param array $structure
     */
    public function __construct(string $name, array $structure)
    {
        $this->name = $name;
        $this->structure = $structure;
    }

    /**
     * @param $table
     */
    public function addTable($table)
    {
        array_push($this->structure,$table);
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return array
     */
    public function getStructure(): array
    {
        return $this->structure;
    }



}