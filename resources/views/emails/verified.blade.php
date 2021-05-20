<!DOCTYPE html>
<html>
<body>

<h2>Hello {{$user->name }}</h2>

<h2>Click <a href="{{url('/user/verify/' .$user->verifyUser->token)}}">here</a> to verify your email</h2>


</body>
</html>
