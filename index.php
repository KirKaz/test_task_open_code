<?php
session_start();
$user = $_SESSION['logged_user'];
?>

    <html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
    <div class="form_div">
    <h2>Добро пожаловать, <?php echo $user['name']; ?></h2>
    <form method='post' action="list.php">
        <input class="button" type='submit' name='logout' value='Просмотр новостей'>
    </form>
    </div>
    </body>
    </html>