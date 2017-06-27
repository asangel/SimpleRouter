<?php

namespace app\classes\base;

class App{
	


    public static function configure($object, $properties)
    {
        foreach ($properties as $name => $value) {
            
            $object->$name = $value;
        }

        return $object;
    }
}