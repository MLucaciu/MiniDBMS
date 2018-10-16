<?php
/**
 * Created by PhpStorm.
 * User: Mircea
 * Date: 10/16/2018
 * Time: 7:32 PM
 */

namespace MiniDBMS\Model\Domain;


class Table
{
    /** @var string */
    private $tableName;
    /** @var string */
    private  $fileName;
    /** @var string */
    private  $rowLength;
    /** @var array of attributes */
    private  $structure;
    /** @var array of strings */
    private  $primaryKeys;
    /** @var array of index files */
    private  $indexFiles;

    /**
     * Table constructor.
     * @param string $tableName
     * @param string $fileName
     * @param string $rowLength
     * @param array $structure
     * @param array $primaryKeys
     * @param array $indexFiles
     */
    public function __construct(string $tableName, string $fileName, string $rowLength, array $structure, array $primaryKeys, array $indexFiles)
    {
        $this->tableName = $tableName;
        $this->fileName = $fileName;
        $this->rowLength = $rowLength;
        $this->structure = $structure;
        $this->primaryKeys = $primaryKeys;
        $this->indexFiles = $indexFiles;
    }

    public function addIndexFile($indexFile)
    {
        array_push($this->indexFiles,$indexFile);
    }
    /**
     * @return string
     */
    public function getTableName(): string
    {
        return $this->tableName;
    }

    /**
     * @return string
     */
    public function getFileName(): string
    {
        return $this->fileName;
    }

    /**
     * @return string
     */
    public function getRowLength(): string
    {
        return $this->rowLength;
    }



}