<!DOCTYPE html>
<html>
<head>
    <title>Welcome Email</title>
</head>

<body>
<h2>Welcome to Clinical Match {{$user['firstname']}} {{$user['lastname']}}</h2>
<br/>
    Your registered email-id is {{$user['email']}} , Please click on the below link to verify your email account
<br/>
<a href="{{route('verify', $user->verifyUser->token)}}">Verify Email</a>
</body>

</html>
