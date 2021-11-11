<?php
require 'connect.php';
session_start();

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

<?php
if (isset($_SESSION['logged_user'])){
    echo '<div class="buttons">';
    echo '<a href="creater.php"><div class = "button" >Написать новость</div></a>';
    echo '<a href="logout.php"><div class = "button" >Сменить пользователя</div></a>';
    echo '</div>';
$list = pg_query($connection, "SELECT * FROM news order by article_id DESC");
while ($article = pg_fetch_assoc($list)){
    echo '<div class = "article_div">' .
        '<h3><a href = article.php?article_id='.$article['article_id'].'>' . $article['title'] . ' </h3></a><br>' .
        date('d-m-Y D', strtotime($article['create_time'])). '<br>' .
        $article['announcement'] . '<br>' .
        pg_fetch_assoc(pg_query($connection, "SELECT login FROM users WHERE user_id = $article[author_id]"))['login'] . '</div>';
}

}
else{
    echo 'Пожалуйста, <a href = login.html>войдите</a> в систему';
}
?>
</body>
</html>