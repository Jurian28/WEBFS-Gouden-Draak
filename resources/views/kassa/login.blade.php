<!DOCTYPE html>
<html>
<head>
    <title>GoodPay Kassa</title>
</head>

<body>
@include('kassa.header')

<div id="loginDiv">
    <form action="{{url("/Authenticate")}}" method="POST">
        @csrf
        <input type="number" name="id" placeholder="Medewerker Nummer" min="1"><br>
        <input type="password" name="password" placeholder="Wachtwoord"><br>
        <input type="submit" value="inloggen"><br>
    </form>
</div>
</body>
</html>






