<?php
require 'connect.php';
session_start();
if (isset($_SESSION['logged_user'])){

    $errors = array();
    $user = $_SESSION['logged_user'];
    $data = $_POST;

    if (isset($data['edit_news'])) {
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
            $pg = pg_update($connection, 'news',
                array('title' => $data['title'], 'announcement' => $data['announcement'], 'full_text' => $data['full_text']),
                array('article_id' => $_GET['article_id']));
            echo 'Новость обновлена. Просмотрите <a href="list.php">полный список</a> новостей';
        }

    }
    $query = pg_query($connection, "SELECT * FROM news WHERE article_id= '$_GET[article_id]'");
    $article = pg_fetch_assoc($query);
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
        <?php  echo '<form action="editor.php?article_id='. $_GET['article_id'] .'" method="post">' ?>
            <p>
            <p><strong>Введите заголовок</strong></p>
            <input class="input_text" type="text" name="title" value="<?php echo @$article['title'] ?>">
            </p>

            <p>
            <p><strong>Введите анонс новости</strong></p>
            <input class="input_text" type="text" name="announcement" value="<?php echo @$article['announcement'] ?>">
            </p>

            <p>
            <p><strong>Текст статьи</strong></p>
            <textarea class="input_textarea" name="full_text"><?php echo @$article['full_text'] ?></textarea>
            </p>


            <button type="submit" name="edit_news" class="button">Изменить</button>



        </form>
    </div>
    </body>
    </html>
