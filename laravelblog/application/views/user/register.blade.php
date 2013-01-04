@layout("master")

@section("content")

<h1>register</h1>

<div class="registerform">
    
    
 
    
{{Form::open("create","POST",array("class"=>"well"))}}

<p>
    {{Form::label("username","username")}}
    {{Form::text("username",Input::old("username"))}}
    
    @if($errors->has("username"))
        {{$errors->first("username","<span class='errors'>:message</span>")}}
    @endif
    
</p>

<p>
    {{Form::label("email","email address")}}
    {{Form::text("email",Input::old("email"))}}
    
    @if($errors->has("email"))
        {{$errors->first("email","<span class='errors'>:message</span>")}}
    @endif
    
</p>

<p>
    {{Form::label("password","password")}}
    {{Form::password("password")}}
    
    
    @if($errors->has("password"))
        {{$errors->first("password","<span class='errors'>:message</span>")}}
    @endif
    
</p>


<p>
    
    
    {{Form::label("password_confirmation","password confirm")}}
    {{Form::password("password_confirmation")}}
    
    @if($errors->has("password_confirmation"))
        {{$errors->first("password_confirmation","<span class='errors'>:message</span>")}}
    @endif
    
</p>


{{Form::token()}}
{{Form::submit("register",array("class"=>"btn btn-primary"))}}
{{Form::close()}}

</div>


@endsection
