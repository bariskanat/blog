@layout("master")

@section("content")

  <?php  
         $id=null;
         if(Auth::check()){ $id=Auth::user()->id;}
         
  ?>
  
  
  @if(count($posts)>0)
  
    @foreach($posts->results as $post)
    
    <div class="well">
        {{HTML::link_to_route("postnew",$post->title,array($post->id))}}
        <p>{{Str::words($post->content,30)}}</p>
        @if($post->user->id==$id)
         {{HTML::link_to_route("deletepost","Delete",array($post->id))}}
        @endif
    </div>
    
    @endforeach
    
    {{$posts->links()}}

@else

    {{HTML::link_to_route("home","go back to main page")}}

@endif

@endsection