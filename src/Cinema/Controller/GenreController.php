<?php
/**
 * Created by PhpStorm.
 * User: mircealucaciu
 * Date: 27.04.2017
 * Time: 17:20
 */

namespace Cinema\Controller;


use Cinema\Model\Repository\GenreRepository;

class GenreController
{
    private $repo;

    /**
     * GenreController constructor.
     */
    public function __construct()
    {
        $this->repo=new GenreRepository();

    }

    /**
     * @param $genre
     */
    public function addGenre($genre){
        $this->repo->add($genre);
    }

    /**
     * @param $id
     * @return string
     */
    public function getAllGenres($id){
        return $this->repo->getAll($id);

    }

    /**
     * @param $id
     */
    public function deleteGenre($id){
        $this->repo->delete($id);

    }

    /**
     * @param $genre
     */
    public function updateGenre($genre){
        $this->repo->update($genre);
    }
}