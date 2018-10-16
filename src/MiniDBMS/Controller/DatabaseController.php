<?php
/**
 * Created by PhpStorm.
 * User: Mircea
 * Date: 10/16/2018
 * Time: 8:00 PM
 */

namespace MiniDBMS\Controller;


use MiniDBMS\Model\Writer\XMLWriter;

class DatabaseController
{
    /** @var \SQLValidator  */
    private $validator;
    /**
     * @var XMLWriter
     */
    private $writer;

    /**
     * DatabaseController constructor.
     */
    public function __construct()
    {
        $this->validator = new \SQLValidator();
        $this->writer = new XMLWriter();
    }

    public function createDatabase($data)
    {
        $this->validator->validate($data);
    }

    public function dropDatabase($data)
    {
        
    }
}