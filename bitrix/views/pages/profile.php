<?php
if(!$_SESSION["user"])
{
    \App\Services\Router::redirect('/');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/assets/css/style.css">
    <title>Профиль</title>
</head>
<body>
    <div>
        <h1 class="profile">Hello, <?=$_SESSION['user']['name']?></h1>
    </div>
    <form action="/auth/logout" method="post">
    <button class="href_button _profile" type="submit">Logout</button>
    </form>
</body>
</html>