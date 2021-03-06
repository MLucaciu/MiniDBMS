<?php
/**
 * Created by PhpStorm.
 * User: mircealucaciu
 */

namespace MiniDBMS\Routing;

use stdClass;

class Route
{
    private $route= [
            "movie" => [
                'controller'=> 'MovieController',
                'GET' => 'getAllMovies',
                'POST'=> 'addMovie',
                'DELETE'=> 'deleteMovie',
                'PUT' => 'updateMovie'
            ],
            "room" => [
                'controller' =>'RoomController',
                'GET' => 'getAllRooms',
                'POST' => 'addRoom',
                'DELETE' => 'deleteRoom',
                'PUT' => 'updateRoom'
            ],
            "genre" => [
                'controller' =>'GenreController',
                'GET' => 'getAllGenres',
                'POST' => 'addGenre',
                'DELETE' => 'deleteGenre',
                'PUT' => 'updateGenre'
             ],
             "booking" => [
                'controller' =>'BookingController',
                'GET' => 'getAllBookings',
                'POST' => 'addBooking',
                'DELETE' => 'deleteBooking',
                'PUT' => 'updateBooking'
            ],
            "schedule" => [
                'controller' =>'ScheduleController',
                'GET' => 'getAllSchedules',
                'POST' => 'addSchedule',
                'DELETE' => 'deleteSchedule',
                'PUT' => 'updateSchedule'
            ],
        ];

    /**
     * @param $method
     * @param $url
     * @param $contents
     * @return Router|stdClass
     */
    public function getRoute($method,$url,$contents){
        $uri=explode('/',$url);
        $controller=$uri[1];
        if(isset($uri[2])){
            $contents['id']=(int)$uri[2];
            if(key_exists($controller,$this->route)){
                $controllerName=$this->route[$controller]['controller'];
                $controllerMethod=$this->route[$controller][$method];

                $route=new Router($controllerName,$contents,$controllerMethod);
                return $route;
            }
        }
        else{
            if(key_exists($controller,$this->route)){
                $controllerName=$this->route[$controller]['controller'];
                $controllerMethod=$this->route[$controller][$method];

                $route=new Router($controllerName,$contents,$controllerMethod);
                return $route;

            }
        }
        return new StdClass();
    }
}
