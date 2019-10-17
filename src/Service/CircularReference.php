<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 17/10/2019
 * Time: 12:29
 */

namespace App\Service;


class CircularReference
{
    public function __invoke($obj)
    {
        return $obj->getId();
    }
}