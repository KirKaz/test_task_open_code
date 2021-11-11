<?php
require 'connect.php';
session_start();
if (isset($_SESSION['logged_user'])){

    $data = $_POST;

    $errors = array();
    $user = $_SESSION['logged_user'];

    if (isset($data['create_news'])) {
        if (trim($data['title']) == '') {
            $errors[] = 'Введите заголовок';
        }

        if (trim($data['announcement']) == '') {
            $errors[] = 'Введите анонс новости';
        }

        if (trim($data['full_text']) == '') {
            $errors[] = 'Введите текст новости';
        }

        if(strlen($data['announcement']) > 200){
            $errors[] = 'Анонс новости не должен превышать 200 символов';
        }

        if (!empty($errors)){
            echo array_shift($errors) ;
        }
        else{
        $pg = pg_query($connection, "INSERT INTO news (title, announcement, full_text, author_id) 
        VALUES ('$data[title]', '$data[announcement]', '$data[full_text]', '$user[user_id]')");
        echo 'Новость добавлена. Просмотрите <a href="list.php">полный список</a> новостей';
        }
    }
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
<div class="buttons">
<a href="list.php"><div class = "button" >К списку новостей</div></a>
</div>
<div class="article_div">
<form action="creater.php" method="post">
    <p>
    <p><strong>Введите заголовок</strong></p>
    <input class="input_text" type="text" name="title" value="<?php echo @$data['title'] ?>">
    </p>

    <p>
    <p><strong>Введите анонс новости</strong></p>
    <input class="input_text" type="text" name="announcement" value="<?php echo @$data['announcement'] ?>">
    </p>

    <p>
    <p><strong>Текст статьи</strong></p>
    <textarea class="input_textarea" name="full_text"><?php echo @$data['full_text'] ?></textarea>
    </p>


    <button type="submit" name="create_news" class="button">Опубликовать</button>



</form>
</div>
</body>
</html>
