<?php

namespace App;

use App\Util\FilterMap;

class Util{
    public static function getType($data){
        $res = gettype($data);
        if($res == "object") $res = "object: ".\get_class($data);
    }
    public static function filterMap($function, $iterable){
        return new FilterMap($function, $iterable);
    }
}