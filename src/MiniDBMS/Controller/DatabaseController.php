<?php
/**
 * Created by PhpStorm.
 * User: Mircea
 * Date: 10/16/2018
 * Time: 8:00 PM
 */

namespace MiniDBMS\Controller;


use MiniDBMS\Model\Writer\JSONWriter;

class DatabaseController
{
    /** @var \SQLValidator  */
    private $validator;
    /**
     * @var JSONWriter
     */
    private $writer;

    /**
     * DatabaseController constructor.
     */
    public function __construct()
    {
        $this->validator = new \SQLValidator();
        $this->writer = new JSONWriter('schema.json');
    }

    public function createDatabase($data)
    {
        $this->validator->validate($data);
        $contents = $this->writer->getContents();
        $this->writer->writeDataBase($data);
    }

    public function dropDatabase($data)
    {
        
    }
}