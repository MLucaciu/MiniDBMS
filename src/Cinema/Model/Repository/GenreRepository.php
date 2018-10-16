<?php
/**
 * Created by PhpStorm.
 * User: mircealucaciu
 * Date: 27.04.2017
 * Time: 17:18
 */

namespace Cinema\Model\Repository;


use Cinema\DBConnection\MyConnection;
use PDO;

class GenreRepository implements CRUDInterface
{
    /**connection to database
     * @var null|PDO
     */
    private $pdo;

    /**
     * GenreRepository constructor.
     */
    public function __construct()
    {
        $connection=new MyConnection();
        $this->pdo=$connection->getPDO();
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->pdo->setAttribute(PDO::ATTR_CASE, PDO::CASE_NATURAL);
    }

    /**
     * @param array $json
     */
    public function add(array $json)
    {
        $name = $json['name'];
        $statement = "INSERT INTO Genre(`name`)
                            VALUES (:name)";
        $stmt = $this->pdo->prepare($statement);
        // Bind parameters values before calling execute()

        $stmt->bindValue('name', $name);
        $stmt->execute();
    }

    /**
     * @param $json
     */
    public function delete($json)
    {
        $id=(int)$json['id'];

        $sql = "UPDATE Genre SET `deleted` = 1 WHERE `ID` = (:id)";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue('id', $id);

        $stmt->execute();
    }

    /**
     * @param array $json
     */
    public function update(array $json)
    {
        $id =(int)$json['id'] ;
        $name=$json['name'];
        $sql = "UPDATE Genre SET `name` = (:name) WHERE `ID` = (:id)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue('id', $id);
        $stmt->bindValue('name', $name);
        $stmt->execute();

    }

    /**
     * @param $id
     * @return string
     */
    public function getAll($id)
    {
        if (isset($id['id'])) {
            $del = $id['id'];
        }
        if (empty($del)) {
            $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_BOTH);

            $sql = "SELECT * FROM Genre WHERE deleted=0";
            $stmt = $this->pdo->query($sql);
            // Set to fetch rows data as associative array
            $stmt->setFetchMode(PDO::FETCH_ASSOC);

            $result = $stmt->fetchAll();


            return $result;
        }else{
            $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_BOTH);

            $sql = "SELECT * FROM Genre WHERE deleted=0 AND ID=$del";
            $stmt = $this->pdo->query($sql);
            // Set to fetch rows data as associative array
            $stmt->setFetchMode(PDO::FETCH_ASSOC);

            $result = $stmt->fetchAll();

            return $result;
        }
    }

}