<?php
/**
 * Created by PhpStorm.
 * User: Mircea
 * Date: 10/17/2018
 * Time: 4:14 PM
 */

namespace MiniDBMS\Model\Writer;


class JSONWriter
{

    /** @var string  */
    private $fileName;
    /** @var mixed  */
    private $contents;

    public function getContents()
    {
        return $this->contents;
    }
    /**
     * JSONWriter constructor.
     * @param string $fileName
     */
    public function __construct(string $fileName)
    {
        $this->fileName = $fileName;
        $this->contents = $this->readFromFile($fileName);
    }

    /**
     * @param $filename
     * @return mixed
     */
    public function readFromFile($filename)
    {
        $contents = file_get_contents('../../../../' . $filename);
        return json_decode($contents);
    }

    /**
     * @return string
     */
    public function getFileName(): string
    {
        return $this->fileName;
    }

    public function writeDataBase($database)
    {

    }

    public function writeTable($table,$database)
    {

    }

    public function writeIndex($table,$database,$index)
    {

    }
}