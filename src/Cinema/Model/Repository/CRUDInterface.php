<?php
/**
 * Created by PhpStorm.
 * User: mircealucaciu
 * Date: 26.04.2017
 * Time: 13:49
 */

namespace Cinema\Model\Repository;


interface CRUDInterface
{
    public function add(array $json);
    public function delete($id);
    public function update(array $json);
    public function getAll($id);

}