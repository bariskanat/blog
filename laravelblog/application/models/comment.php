<?php 

class Comment extends Main{
    
    public static $rules=array(
        "comment"  =>"required|min:10"
    );
    
    
    public function post()
    {
        return $this->belongs_to("Post");
    }
    
    public function user()
    {
       return $this->belongs_to("User");
    }
}