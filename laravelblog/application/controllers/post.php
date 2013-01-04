<?php

class Post_Controller extends Base_Controller{
    
    public $restful=true;
    
    public function get_index()
    { 
        $posts=Post::with("user")->order_by("id","DESC")->paginate(15);
        
        return View::make("post.all",array("posts"=>$posts));
    }
    
    
    public function get_show($id)
    {
        
        $post=Post::with(array("user","comments"))->where("id","=",$id)->first(); 
        $comments=Comment::with(array("user"))->where("post_id","=",$id)->order_by("id","DESC")->get();
     
        return View::make("post.index")
                    ->with("post",$post)
                    ->with("comments",$comments);
    }
    
    public function get_delete($id)
    {
        if(Auth::guest())
             return Redirect::back();
        
        Post::where("id","=",$id)->where("user_id","=",Auth::user()->id)->delete();
        
        return Redirect::to_route("you",array(Auth::user()->id));
        
    }
    
    public function get_deletecomment($id)
    {
        if(Auth::guest())
             return Redirect::back();
        
        Comment::where("id","=",$id)->where("user_id","=",Auth::user()->id)->delete();
        
        return Redirect::to_route("postnew",array(Auth::user()->id));
        
    }
    
    
    
    
    
     
    public function post_comment()
    {
        if(Auth::guest())
            return Redirect::to_route("home");
        
        $v = Comment::validate(array("comment"=>Input::get("comment")));
         
         if($v->fails()){
             return Redirect::back()->with_input()->with_errors($v);
         }else{
             $result=Comment::create(array(
                 "user_id" =>Auth::user()->id,
                 "post_id" =>Input::get("post_id"),
                 "comment" =>Input::get("comment")
             ));
             
             return ($result) ? Redirect::to_route("postnew",array(Auth::user()->id)):Redirect::to_route("postnew")->with_input();
         }
             
    }
    
  
    
}
