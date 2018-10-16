<?php
/**
 * Created by PhpStorm.
 * User: mircealucaciu
 * Date: 27.04.2017
 * Time: 17:19
 */

namespace Cinema\Model\Repository;


use Cinema\DBConnection\MyConnection;
use Exception;
use PDO;

class BookingRepository implements CRUDInterface
{
    /**connection to database
     * @var null|PDO
     */
    private $pdo;

    /**
     * BookingRepository constructor.
     */
    public function __construct()
    {
        $connection=new MyConnection();
        $this->pdo=$connection->getPDO();
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->pdo->setAttribute(PDO::ATTR_CASE, PDO::CASE_NATURAL);
    }

    /**
     * @param array $booking
     * @throws Exception
     */
    public function add(array $booking)
    {
        try {

            $this->pdo->beginTransaction();
            //receveing the schedule id from teh json file
            $id_sch = intval($booking['id_sch']);
            //preparing the statement
            $sql = "SELECT * FROM Schedule WHERE deleted=0 AND ID={$this->pdo->quote($id_sch)}";

            $stmtt = $this->pdo->query($sql);
            $stmtt->setFetchMode(PDO::FETCH_ASSOC);
            //getting all the schedules
            $result = $stmtt->fetchAll();

            if (count($result) > 0) {
                //found so we update the Schedule table and insert in Booking table
                $time = $booking['time'];
                $date_s = $booking['date_s'];
                $seats = (int)$booking['seats'];
                //$id_sch = (int)$booking['id_sch'];
                $statementr = "INSERT INTO Booking(`time`,`seats`,`id_sch`,`date_s`)
                            VALUES (:time,:seats,:id_sch,:date_s)";

                $stmtr = $this->pdo->prepare($statementr);
                $stmtr->bindValue('time', $time);
                $stmtr->bindValue('seats', $seats);
                $stmtr->bindValue('id_sch', $id_sch);
                $stmtr->bindValue('date_s', $date_s);
                $stmtr->execute();
                //get schedule remain seats

                $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_BOTH);

                $sql = "SELECT * FROM Schedule WHERE deleted=0;";
                $stmt = $this->pdo->query($sql);

                $stmt->setFetchMode(PDO::FETCH_ASSOC);

                $result = $stmt->fetchAll();
                //getting the remainign seats from the Schedule table
                $updatedSeats = (int)$result[0]['remaining_seats'];
                //statement to update the seats in the schedule table
                $sql = "UPDATE Schedule SET `remaining_seats` = (:updatedSeats) WHERE `ID` = (:id)";
                $stmt = $this->pdo->prepare($sql);
                //updating the seats
                $updatedSeats = $updatedSeats - (int)$seats;

                $stmt->bindValue('updatedSeats', $updatedSeats);
                $stmt->bindValue('id', $id_sch);
                $stmt->execute();


            } else {
                $this->pdo->RollBack();
                throw new Exception ("the schedule with that id does not exist");
            }
            $this->pdo->commit();

        } catch (Exception $e) {
            throw new Exception('error...');
        }
    }

    /**
     * @param $id
     */
    public function delete($id)
    {
        $del=(int)$id['id'];
        $sql = "UPDATE Booking SET `deleted` = 1 WHERE `ID` = (:id)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue('id', $del);
        $stmt->execute();
    }

    /**
     * @param array $booking
     */
    public function update(array $booking)
    {
        $id = (int)$booking['id'];
        $time = $booking['time'];
        $seats = $booking['seats'];
        $id_sch = $booking['id_sch'];
        $date_s = $booking['date_s'];

        $sql = "UPDATE Booking SET `time` = (:time) , `seats` = (:seats) , `id_sch` = (:id_sch) , `date_s` = (:date_s) WHERE `ID` = (:id)";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue('id', $id);
        $stmt->bindValue('time', $time);
        $stmt->bindValue('seats', $seats);
        $stmt->bindValue('id_sch', $id_sch);
        $stmt->bindValue('date_s', $date_s);
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

            $sql = "SELECT * FROM Booking WHERE deleted=0";
            $stmt = $this->pdo->query($sql);
            // Set to fetch rows data as associative array
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetchAll();

            return $result;
        }
        else{
            $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_BOTH);

            $sql = "SELECT * FROM Booking WHERE deleted=0 AND ID=$del";
            $stmt = $this->pdo->query($sql);
            // Set to fetch rows data as associative array
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetchAll();

            return $result;
        }
    }


}