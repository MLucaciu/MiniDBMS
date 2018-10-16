<?php
/**
 * Created by PhpStorm.
 * User: mircealucaciu
 * Date: 26.04.2017
 * Time: 17:03
 */

namespace Cinema\Controller;

use Cinema\Model\Domain\Movie;
use Cinema\Model\Repository\MovieRepository;

class MovieController
{
    /**
     * @var MovieRepository
     */
    private $repo;

    /**
     * MovieController constructor.
     */
    public function __construct()
    {
        $this->repo=new MovieRepository();

    }

    /**
     * @param $movie
     */
    public function  addMovie($movie){
        $this->repo->add($movie);
    }

    /**
     * @param $movie
     */
    public function updateMovie($movie){
        $this->repo->update($movie);
    }

    /**
     * @param $movie
     * @return string
     */
    public function getAllMovies($movie){
        return $this->repo->getAll($movie);
    }

    /**
     * @param $movie
     */
    public function deleteMovie($movie){
        $this->repo->delete($movie);
    }
}