@layout("master")


@section("content")

@if(Session::has("message"))
<p class="message">
  {{Session::get("message")}}
</p>

@endif



    
   @foreach($posts->results as $p)
        <div class="well">
            
            <h1>{{$p->title}}</h1>
            by <span>{{HTML::link_to_route("you",$p->user->username,array($p->user->id))}}</span>
            <p>{{Str::words($p->content,30)}}</p>
            
        </div>
   
@endforeach

{{$posts->links()}}
 

@endsection
