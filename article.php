<?php
require 'connect.php';
session_start();
if (isset($_SESSION['logged_user'])){
    $data = $_POST;
    $page = $_GET['article_id'];
    $user = $_SESSION['logged_user'];

    $query = pg_query($connection, "SELECT * FROM news WHERE article_id= '$page'");
    $article = pg_fetch_assoc($query);
    echo '<div class = "article_div">' .
        '<h3>' . $article['title'] . ' </h3><br>' .
        '<p><b>' . pg_fetch_assoc(pg_query($connection, "SELECT login FROM users WHERE user_id = $article[author_id]"))['login'] . '</b></p>' .
        '<p>' . $article['full_text'] . '</p>' .
        '<p>' . date('d-m-Y D', strtotime($article['create_time'])) . '</p></div>';
    echo '<form action="list.php" class = "button_form">';
    echo '<button type="submit" class = "button" >Назад</button>';
    if ($user['login'] == pg_fetch_assoc(pg_query($connection, "SELECT login FROM users WHERE user_id = $article[author_id]"))['login'])
        echo '<a class = "button" href="editor.php?article_id='.$_GET['article_id'].'">Редактировать</a>';
    echo '</form>';

}

else{
    echo 'Пожалуйста, <a href = login.html>войдите</a> в систему';
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

</body>
</html>
