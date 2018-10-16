<?php
/**
 * Created by PhpStorm.
 * User: mircealucaciu
 * Date: 27.04.2017
 * Time: 17:20
 */

namespace Cinema\Controller;


use Cinema\Model\Repository\ScheduleRepository;

class ScheduleController
{
    /**
     * @var ScheduleRepository
     */
    private $repo;

    /**
     * ScheduleController constructor.
     */
    public function __construct()
    {
        $this->repo = new ScheduleRepository();
    }

    /**
     * @param $schedule
     */
    public function addSchedule($schedule){
        $this->repo->add($schedule);
    }

    /**
     * @param $id
     */
    public function deleteSchedule($id){
        $this->repo->delete($id);
    }

    /**
     * @param $id
     * @return array
     */
    public function getAllSchedules($id){
        return $this->repo->getAll($id);
    }

    /**
     * @param $schedule
     */
    public function updateSchedule($schedule){
        $this->repo->update($schedule);
    }

}