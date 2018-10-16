<?php
/**
 * Created by PhpStorm.
 * User: mircealucaciu
 * Date: 27.04.2017
 * Time: 17:20
 */

namespace Cinema\Controller;


use Cinema\Model\Repository\BookingRepository;

class BookingController
{
    /**
     * @var BookingRepository
     */
    private $repo;

    /**
     * ScheduleController constructor.
     */
    public function __construct()
    {
        $this->repo = new BookingRepository();
    }

    /**
     * @param $booking
     */
    public function addBooking($booking){
        $this->repo->add($booking);
    }

    /**
     * @param $id
     */
    public function deleteBooking($id){
        $this->repo->delete($id);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getAllBookings($id){
        return $this->repo->getAll($id);
    }

    /**
     * @param $booking
     */
    public function updateBooking($booking){
        $this->repo->update($booking);
    }
}