<?php
/**
 * Created by PhpStorm.
 * User: mircealucaciu
 * Date: 26.04.2017
 * Time: 13:32
 */

namespace Cinema\Model\Domain;


class Movie
{
    /**
     * @string
     */
    private $title;
    /**
     * @int
     */
    private $appar_year;
    /**
     * @string
     */
    private $cast;
    /**
     * @int
     */
    private $duration;
    /**
     * @string
     */
    private $poster;
    /**
     * @string
     */
    private $linkImdb;

    /**
     * Movie constructor.
     * @param $title
     * @param $appar_year
     * @param $cast
     * @param $duration
     * @param $poster
     * @param $linkImdb
     */
    public function __construct($title, $appar_year, $cast, $duration, $poster, $linkImdb)
    {
        $this->title = $title;
        $this->appar_year = $appar_year;
        $this->cast = $cast;
        $this->duration = $duration;
        $this->poster = $poster;
        $this->linkImdb = $linkImdb;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return mixed
     */
    public function getApparYear()
    {
        return $this->appar_year;
    }

    /**
     * @return mixed
     */
    public function getCast()
    {
        return $this->cast;
    }

    /**
     * @return mixed
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * @return mixed
     */
    public function getPoster()
    {
        return $this->poster;
    }

    /**
     * @return mixed
     */
    public function getLinkImdb()
    {
        return $this->linkImdb;
    }



}