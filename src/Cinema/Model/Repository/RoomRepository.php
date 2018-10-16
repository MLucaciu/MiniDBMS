<?php
/**
 * Created by PhpStorm.
 * User: mircealucaciu
 * Date: 26.04.2017
 * Time: 13:52
 */

namespace Cinema\Model\Repository;



use Cinema\DBConnection\MyConnection;
use PDO;

class RoomRepository implements CRUDInterface
{
    /**connection to database
     * @var null|PDO
     */
    private $pdo;

    /**
     * RoomRepository constructor.
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
        $capacity=(int)$json['capacity'];
        $statement = "INSERT INTO Room(`name`,`capacity`)
                            VALUES (:name,:capacity)";
        $stmt = $this->pdo->prepare($statement);
        $stmt->bindValue('name', $name);
        $stmt->bindValue('capacity', $capacity);
        $stmt->execute();

    }

    /**
     * @param $json
     */
    public function delete($json)
    {
        $id=(int)$json['id'];
        $sql = "UPDATE Room SET `deleted` = 1 WHERE `ID` = (:id)";
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
        $capacity=(int)$json['capacity'];
        $sql = "UPDATE Room SET `name` = (:name) , `capacity` = (:capacity) WHERE `ID` = (:id)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue('id', $id);
        $stmt->bindValue('capacity', $capacity);
        $stmt->bindValue('name', $name);
        $stmt->execute();


    }

    /**
     * @param $id
     * @return array
     */
    public function getAll($id)
    {
        if(isset($id['id'])){
            $del=$id['id'];
        }
        if(empty($del)){
            $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_BOTH);

            $sql = "SELECT * FROM Room WHERE deleted=0";
            $stmt = $this->pdo->query($sql);
            // Set to fetch rows data as associative array
            $stmt->setFetchMode(PDO::FETCH_ASSOC);

            // Fetch all
            $result = $stmt->fetchAll();

            //$jsonResult=json_encode($result);

            return $result;
        }
        else{
            $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_BOTH);
            $del=(int)$del;
            $sql = "SELECT * FROM Room WHERE deleted=0 AND ID=$del";
            $stmt = $this->pdo->query($sql);
            // Set to fetch rows data as associative array
            $stmt->setFetchMode(PDO::FETCH_ASSOC);

            // Fetch all
            $result = $stmt->fetchAll();

            //$jsonResult=json_encode($result);

            return $result;
        }

    }



}