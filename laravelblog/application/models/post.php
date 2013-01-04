<?php

class Post extends Main{
    
    
    public static $rules=array(
        "title"     =>"required|min:10|max:220",
        "content"   =>"required|min:10"
        
        
    );
   
    
    public function user()
    {
        return $this->belongs_to("User");
    }
    
    public function comments()
    {
        return $this->has_many("Comment");
    }
    
}