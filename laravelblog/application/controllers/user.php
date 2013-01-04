<?php
class User_Controller extends Base_Controller{
    
    
    public $restful=true;
    
    
    
    public function get_new()
    {
        return View::make("user.register");
    }
    
    public function get_index()
    {
        return View::make("home.index",array(
            "users"   => Post::all()
        ));
    }
    
   
    
    
    
    
    public function get_login()
    {
        if(Auth::check())return Redirect::to_route("home");
        
        return View::make("user.login");
    }
    
    public function get_you($id)
    {
       
        $posts=Post::with("user")->where("user_id","=",$id)->order_by("id","DESC")->paginate(15);
      
        return View::make("user.you",array("posts"=>$posts));
    }
    
    
    public function post_login()
    {
        if(Auth::check())return Redirect::to_route("home");
        $user=array(
            "username"   =>Input::get("email"),
            "password"   =>Input::get("password")
        );
        
        if(Auth::attempt($user)){
           
            return Redirect::to_route("you",array(Auth::user()->id));
            
        }else{
            
            return Redirect::back()->with("message","email/password combination was not correct")
                             ->with_input();
        }
        
    }
    
    
    public function get_logout()
    {
       
        if(Auth::check())
        {
            Auth::logout();
            return Redirect::to_route("home")
                             ->with("message","you have logged out ");
            
        }
        
        return Redirect::to_route("home");
    }
    
    public function get_blog()
    {
        return View::make("user.createpost");
    }
    
    public function post_blog()
    {
        $v=Post::validate(Input::all());
        
        if($v->fails()){
            
            return Redirect::back()->with_input()->with_errors($v);
        }else{
            
            $userid=Auth::user()->id;
            
            $result=User::find($userid)->posts()->insert(array(
                "title"     => Input::get("title"),
                "content"   => Input::get("content")
                
            ));
            
            return ($result)
                   ? Redirect::to_route("you",array(Auth::user()->id))
                   :Redirect::back()->with_input()->with("message","Database connection problem ");
        }
    }
    
    
    
    
    public function post_create()
    {
        
        $v=User::validate(Input::all());
        
        if($v->fails()){
          
            return Redirect::to_route("registeruser")
                         ->with_errors($v)
                         ->with_input();
        }else{
          
            $result=User::create(array(
                "username"  =>Input::get("username"),
                "email"     =>Input::get("email"),
                "password"  =>Hash::make(Input::get("password"))
            ));
            
            return ($result)
                    ? Redirect::to_route("home")->with("message","you have successfully registered ")
                    : Redirect::to_route("registeruser")
                                ->with_errors($v)
                                ->with_input();
        }
    }
    
    
    
}