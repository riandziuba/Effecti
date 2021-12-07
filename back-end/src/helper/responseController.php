<?php

namespace Riandziuba\Effecti\helper;


class responseController {

    public static function jsonResponse($object){

        header('Content-Type: application/json', true);
        echo json_encode($object);
        exit();

    }

}