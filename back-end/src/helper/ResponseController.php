<?php

namespace Riandziuba\Effecti\helper;


class ResponseController {

    public static function jsonResponse($object){

        header('Content-Type: application/json', true);
        echo json_encode($object);
        exit();

    }

}