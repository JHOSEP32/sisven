<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HelperFunctions extends Controller
{

    //Helper Classes

    public static function shortText($string, $length = NULL)
    {
        //Si no se especifica la longitud por defecto es 50
        if ($length == NULL)
            $length = 25;
        //Primero eliminamos las etiquetas html y luego cortamos el string
        $stringDisplay = substr(strip_tags($string), 0, $length);
        //Si el texto es mayor que la longitud se agrega puntos suspensivos
        if (strlen(strip_tags($string)) > $length)
            $stringDisplay .= ' ...';
        return $stringDisplay;
    }

}
