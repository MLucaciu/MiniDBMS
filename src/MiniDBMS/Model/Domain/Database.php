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
    private $tableCollection;

    /**
     * Database constructor.
     * @param string $name
     * @param array $tableCollection
     */
    public function __construct(string $name, array $tableCollection)
    {
        $this->name = $name;
        $this->tableCollection = $tableCollection;
    }

    /**
     * @param $table
     */
    public function addTable($table)
    {
        array_push($this->tableCollection,$table);
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
    public function getTableCollection(): array
    {
        return $this->tableCollection;
    }

    /**
     * @param array $tableCollection
     */
    public function setTableCollection(array $tableCollection): void
    {
        $this->tableCollection = $tableCollection;
    }


}