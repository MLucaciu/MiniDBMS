<?php
/**
 * Created by PhpStorm.
 * User: mircealucaciu
 * Date: 26.04.2017
 * Time: 13:52
 */

namespace Cinema\DBConnection;


use PDO;
use PDOException;

class MyConnection
{
    public function getPDO()
    {
        $username = 'root';
        $password = 'Mircea123.';

        $pdo = null;

        try {
            $dsn = "mysql:host=localhost;port=3306;dbname=task";
            $pdo = new PDO($dsn, $username, $password);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $pdo;
    }
}
