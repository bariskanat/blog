<?php

class User extends Main{
    
    
    public static $rules=array(
        "username"              => "required|min:5|unique:users|max:70|alpha_dash",
        "email"                 => "required|email|unique:users",
        "password"              => "required|min:6|confirmed"
        
        
    );
    
    
    
    
    public function posts()
    {
        return $this->has_many("Post");
    }
    
    
    public function comments()
    {
        return $this->has_many("Comment");
    }
//    
//    
//    public function friends()
//    {
//        return $this->has_many("friend");
//    }
    
   
}
