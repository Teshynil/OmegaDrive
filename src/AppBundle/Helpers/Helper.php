<?php

/*
 * @Author: Carlos Adrián Domínguez Sárate
 */

namespace AppBundle\Helpers;

/**
 * Description of Helper
 *
 * @author soporte
 */
class Helper {
    public static function decode($encoded){
        $json=base64_decode($encoded);
        return json_decode($json);
    }
}
