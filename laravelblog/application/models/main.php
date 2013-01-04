<?php

class Main extends Eloquent{
    
    
    
    public static function validate($input)
    {
        return Validator::make($input,static::$rules);
    }
    
    
   
    
}
