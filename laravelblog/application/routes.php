<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Simply tell Laravel the HTTP verbs and URIs it should respond to. It is a
| breeze to setup your application using Laravel's RESTful routing and it
| is perfectly suited for building large applications and simple APIs.
|
| Let's respond to a simple GET request to http://example.com/hello:
|
|		Route::get('hello', function()
|		{
|			return 'Hello World!';
|		});
|
| You can even respond to more than one URI:
|
|		Route::post(array('hello', 'world'), function()
|		{
|			return 'Hello World!';
|		});
|
| It's easy to allow URI wildcards using (:num) or (:any):
|
|		Route::put('hello/(:any)', function($name)
|		{
|			return "Welcome, $name.";
|		});
|
*/
//Route::get("(:any)",function($name){
//    
//    $url=Url::where("shorthen","=",$name)->first();
// 
//    if(is_null($url))  return Redirect::to("/");
//    
//    return Redirect::to($url->url);
//});



Route::get("/",array("as"=>"home","uses"=>"post@index"));
Route::get("register",array("as"=>"registeruser","uses"=>"user@new"));
Route::post("create",array("before"=>"csrf","as"=>"signup","uses"=>"user@create"));
Route::get("login",array("as"=>"login","uses"=>"user@login"));
Route::get("post",array("before","auth","as"=>"createpost","uses"=>"user@blog"));
Route::get("post/(:num)",array("as"=>"postnew","uses"=>"post@show"));
Route::get("delete/(:num)",array("before","auth","as"=>"deletepost","uses"=>"post@delete"));
Route::get("deletecomment/(:num)",array("before","auth","as"=>"deletecomment","uses"=>"post@deletecomment"));
Route::post("blog",array("as"=>"savepost","uses"=>"user@blog"));
Route::post("newcomment",array("before","auth","as"=>"newcomment","uses"=>"post@comment"));
Route::get("logout",array("as"=>"logout","uses"=>"user@logout"));
Route::get("user/(:any)",array("as"=>"you","uses"=>"user@you"));
Route::post("login",array("before"=>"csrf","as"=>"loginuser","uses"=>"user@login"));

//Route::controller("home");

//Route::get('/', function()
//{
//    return View::make("home.form")
//                 ->with("baris","baris kanat");
//  
//});

//Route::post("/", function()
//{
//    
//       $v=Url::validate(array("url"=>Input::get("username")));
//       
//       if($v!==true)
//       {
//           return Redirect::to("/")->with_errors($v->errors);
//       }
//       $url=Url::where("url","=",Input::get("username"))->first();
//       if($url)
//       {
//          return View::make("home.result")->with("url",$url);
//       }else{
//           $shorthen=Url::get_unique_url();
//           
//           
//           
//           $row=Url::create(array(
//               "url"  =>Input::get("username"),
//               "shorthen" =>$shorthen
//           ));
//           
//           if($row)
//           {
//             return Redirect::to($row->url);  
//           }
//       }     
//       
//      
//       
//});





/*
|--------------------------------------------------------------------------
| Application 404 & 500 Error Handlers
|--------------------------------------------------------------------------
|
| To centralize and simplify 404 handling, Laravel uses an awesome event
| system to retrieve the response. Feel free to modify this function to
| your tastes and the needs of your application.
|
| Similarly, we use an event to handle the display of 500 level errors
| within the application. These errors are fired when there is an
| uncaught exception thrown in the application.
|
*/

Event::listen('404', function()
{
	return Response::error('404');
});

Event::listen('500', function()
{
	return Response::error('500');
});

/*
|--------------------------------------------------------------------------
| Route Filters
|--------------------------------------------------------------------------
|
| Filters provide a convenient method for attaching functionality to your
| routes. The built-in before and after filters are called before and
| after every request to your application, and you may even create
| other filters that can be attached to individual routes.
|
| Let's walk through an example...
|
| First, define a filter:
|
|		Route::filter('filter', function()
|		{
|			return 'Filtered!';
|		});
|
| Next, attach the filter to a route:
|
|		Router::register('GET /', array('before' => 'filter', function()
|		{
|			return 'Hello World!';
|		}));
|
*/

Route::filter('before', function()
{
	// Do stuff before every request to your application...
});

Route::filter('after', function($response)
{
	// Do stuff after every request to your application...
});

Route::filter('csrf', function()
{
	if (Request::forged()) return Response::error('500');
});

Route::filter('auth', function()
{
	if (Auth::guest()) return Redirect::to('login');
});