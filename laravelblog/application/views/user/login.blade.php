@layout("master")


@section("content")



<div class="">

    @if(Session::has("message"))

        <p class="alert alert-success">
            {{Session::get("message")}} 
        </p>

    @endif

    {{Form::open("login","POST",array("class"=>"well"))}}

    <p>
        {{Form::label("email","email address")}}
        {{Form::text("email",Input::old("email"))}}
    </p>

    <p>
        {{Form::label("password","password")}}
        {{Form::password("password")}}
    </p>

    {{Form::token()}}
    {{Form::submit("Login",array("class"=>"btn btn-primary"))}}



    {{Form::close()}}

</div>






@endsection