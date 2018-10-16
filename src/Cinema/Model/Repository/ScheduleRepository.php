<?php
/**
 * Created by PhpStorm.
 * User: mircealucaciu
 * Date: 27.04.2017
 * Time: 17:19
 */

namespace Cinema\Model\Repository;


use Cinema\DBConnection\MyConnection;
use PDO;

class ScheduleRepository implements CRUDInterface
{
    /**
     * @var null|PDO
     */
    private $pdo;
    /**
     * ScheduleRepository constructor.
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
        $time = $json['time'];
        $remaining_seats=(int)$json['remaining_seats'];
        $ticket_price= (int)$json['ticket_price'];
        $date_s=$json['date_s'];
        $id_movie=(int)$json['id_movie'];
        $id_room=(int)$json['id_room'];
        $statement = "INSERT INTO Schedule(`time`,`remaining_seats`,`ticket_price`,`date_s`,`id_movie`,`id_room`)
                            VALUES (:time,:remaining_seats,:ticket_price,:date_s,:id_movie,:id_room)";
        $stmt = $this->pdo->prepare($statement);

        $stmt->bindValue('time', $time);
        $stmt->bindValue('remaining_seats', $remaining_seats);
        $stmt->bindValue('ticket_price', $ticket_price);
        $stmt->bindValue('date_s', $date_s);
        $stmt->bindValue('id_movie', $id_movie);
        $stmt->bindValue('id_room', $id_room);

        $stmt->execute();
    }

    /**
     * @param $schedule
     */
    public function delete($schedule)
    {
        $id=(int)$schedule['id'];
        $sql = "UPDATE Schedule SET `deleted` = 1 WHERE `ID` = (:id)";
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
        $time = $json['time'];
        $remaining_seats=(int)$json['remaining_seats'];
        $ticket_price= (int)$json['ticket_price'];
        $date_s=$json['date_s'];
        $id_movie=(int)$json['id_movie'];
        $id_room=(int)$json['id_room'];

        $sql = "UPDATE Schedule SET `time` = (:time) , `remaining_seats` = (:remaining_seats) , `ticket_price` = (:ticket_price),
                 `date_s` = (:date_s) , `id_movie` = (:id_movie) , `id_room`= (:id_room) WHERE `ID` = (:id)";


        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue('id', $id);
        $stmt->bindValue('time', $time);
        $stmt->bindValue('remaining_seats', $remaining_seats);
        $stmt->bindValue('ticket_price', $ticket_price);
        $stmt->bindValue('date_s', $date_s);
        $stmt->bindValue('id_movie', $id_movie);
        $stmt->bindValue('id_room', $id_room);
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
        if(empty($del)) {
            $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_BOTH);

            $sql = "SELECT * FROM Schedule WHERE deleted=0";
            $stmt = $this->pdo->query($sql);
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetchAll();

            return $result;
        }
        else{
            $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_BOTH);

            $sql = "SELECT * FROM Schedule WHERE deleted=0 AND ID=$del";
            $stmt = $this->pdo->query($sql);
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetchAll();

            return $result;
        }
    }


}