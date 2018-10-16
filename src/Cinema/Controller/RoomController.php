<?php
/**
 * Created by PhpStorm.
 * User: mircealucaciu
 * Date: 27.04.2017
 * Time: 07:58
 */

namespace Cinema\Controller;


use Cinema\DBConnection\MyConnection;
use Cinema\Model\Domain\Room;
use Cinema\Model\Repository\RoomRepository;
use PDO;

class RoomController
{
    private $repo;

    /**
     * RoomController constructor.
     */
    public function __construct()
    {
        $this->repo=new RoomRepository();

    }

    /**
     * @param $room
     */
    public function addRoom($room){
        $this->repo->add($room);
    }

    /**
     * @param $id
     * @return array
     */
    public function getAllRooms($id){
        return $this->repo->getAll($id);

    }

    /**
     * @param $id
     */
    public function deleteRoom($id){
        $this->repo->delete($id);

    }

    /**
     * @param $room
     */
    public function updateRoom($room){
        $this->repo->update($room);
    }
}