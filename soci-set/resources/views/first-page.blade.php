<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
</head>
<body>
<div class="page-first">
    <h1>To view main content Log In or Sign Up</h1>
    <form action="sign-up" method="post">
    @csrf
        <h3>Sign Up</h3>
        <input type="text" name="name" placeholder="name"><br>
        <input type="password" name="password" placeholder="password"><br>
        <input type="submit" value="Sign Up">
        @if(isset($err_signup))
            {{$err_signup}}
        @endif
    </form>
    <form action="log-in" method="get">
        <h3>Log In</h3>
        <input type="text" name="name" placeholder="name"><br>
        <input type="password" name="password" placeholder="password"><br>
        <input type="submit" value="Log In">
        @if(isset($err_login))
            {{$err_login}}
        @endif
    </form>
</div>
</body>
</html>