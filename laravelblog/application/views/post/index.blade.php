@layout("master")


@section("content")

@if(Session::has("message"))
<p class="message">
  {{Session::get("message")}}
</p>

@endif


<div class="postdetails">
   
    <h1>{{$post->title}}</h1>
    by <span>{{HTML::link_to_route("you",$post->user->username,array($post->user->id))}}</span>
    <p>{{$post->content}}</p>
    
    @if(count($comments)>0)
    <div class="well">
        @foreach($comments as $comment)

            <div class="commentgen" >

                <p class="userinfo">{{HTML::link_to_route("you",$comment->user->username,array($comment->user->id))}}</p>
                <p class="comment">{{$comment->comment}}</p>
                
                 @if(Auth::check())
                    @if(Auth::user()->id==$comment->user->id)
                        {{HTML::link_to_route("deletecomment","delete",array($comment->id))}}
                    @endif
                 @endif

            </div>
        @endforeach
    </div>
    @endif
    
    @if(Auth::check())
     
    @if($errors->has("comment"))
        {{$errors->first("comment","<p class='alert alert-success'>:message</span>")}}    
    @endif
    
    
     {{Form::open("newcomment","POST",array("class"=>"well"))}}
     
     <p>{{Form::textarea("comment",Input::old("comment"))}}</p>
     {{Form::token()}}
     {{Form::hidden("post_id",$post->id)}}
     
     {{Form::submit("add comment",array("class"=>"btn btn-primary"))}}
     
     {{Form::close()}}
    
    @endif
</div>


@endsection