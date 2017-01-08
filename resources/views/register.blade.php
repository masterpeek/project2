<html>
<head>
    <meta charset="utf-8">
    <body>
{!! Form::open(['url' => 'addUser', 'method' => 'post']) !!}
<h1>Register</h1>
Username : {!! Form::text('username') !!} <br><br>
Password : {!! Form::text('password') !!} <br><br>
First Name : {!! Form::text('fname') !!} <br><br>
Last Name : {!! Form::text('lname') !!} <br><br>
Tel : {!! Form::text('tel') !!} <br><br>
E-mail : {!! Form::text('email') !!} <br><br>
{!! Form::submit('submit') !!}
{!! Form::close() !!}
    </body>
</head>
</html>