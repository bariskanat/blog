@layout("master")


@section("content")


@if(Session::has("message"))

<p class="message">
    {{ Session::get("message") }}
</p>
@endif
<div class="registerform">
    
    
 
    
{{Form::open("blog","POST",array("class"=>"well"))}}

<p>
    {{Form::label("title","title")}}<br/>
    {{Form::text("title",Input::old("title"))}}
    
    @if($errors->has("title"))
        {{$errors->first("title","<span class='errors'>:message</span>")}}
    @endif
    
</p>

<p>
    {{Form::label("content","Content")}}<br/>
    {{Form::textarea("content",Input::old("content"))}}
    
    @if($errors->has("content"))
        {{$errors->first("content","<span class='errors'>:message</span>")}}
    @endif
    
</p>



{{Form::token()}}
{{Form::submit("create",array("class"=>"btn btn-primary"))}}
{{Form::close()}}

</div>




@endsection
