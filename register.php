<?php
function connect()
{
    $servername = "localhost";
    $username = "postgres";
    $password = "1234";
    $dbname = "postgres";
    try {
        $conn = pg_connect('host=' . $servername . ' user=' . $username .
            ' password=' . $password . ' dbname=' . $dbname);
        if ($conn != false)
            return $conn;
        else echo "error";
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}
$connection = connect();

$data = $_POST;

$errors = array();

if (isset($data['do_signup'])){
    if(trim($data['login']) == ''){
        $errors[] = 'Введите логин';
    }

    if(trim($data['name']) == ''){
        $errors[] = 'Введите имя';
    }

    if(trim($data['mail']) == ''){
        $errors[] = 'Введите Email';
    }

    if(trim($data['password']) == ''){
        $errors[] = 'Введите пароль';
    }

    if(trim($data['password_again']) != $data['password']){
        $errors[] = 'Повторный пароль введен неверно';
    }

    $uniqueCheckQ = pg_query($connection,"SELECT * FROM users WHERE mail = '$data[mail]'");
    $validator = pg_fetch_assoc($uniqueCheckQ);
    if ($validator != false){
        $errors[] = 'Такая почта уже зарегистрирована';
    }

    $uniqueCheckQ = pg_query($connection,"SELECT * FROM users WHERE login = '$data[login]'");
    $validator = pg_fetch_assoc($uniqueCheckQ);
    if ($validator != false){
        $errors[] = 'Такой логин уже существует';
    }

    if (!preg_match("#^[aA-zZ0-9]#", $data['password'])) {
        $errors[] = 'В пароле допустимы только латинскик буквы и цифры';
    }

    if (!empty($errors)) {
        echo array_shift($errors) ;
    } else {
        $pg = pg_query($connection, "INSERT INTO users (mail, pass, name, login) VALUES ('$data[mail]', '$data[password]', '$data[name]', '$data[login]')");
        echo 'Вы успешно зарегистрировались!';
    }
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
<div class="form_div">
<form action="register.php" method="post">
    <p>
        <p><strong>Ваш логин</strong></p>
        <input type="text" name="login" value="<?php echo @$data['login'] ?>" placeholder="Введите login" >
    </p>

    <p>
    <p><strong>Ваше имя</strong></p>
    <input type="text" name="name" value="<?php echo @$data['name'] ?>" placeholder="Введите имя">
    </p>

    <p>
    <p><strong>Ваш Email</strong></p>
    <input type="email" name="mail" value="<?php echo @$data['mail'] ?>" placeholder="Введите Email">
    </p>

    <p>
    <p><strong>Ваш пароль</strong></p>
    <input type="password" name="password" value="<?php echo @$data['password'] ?>" placeholder="***********">
    </p>

    <p>
    <p><strong> Повторите пароль</strong></p>
    <input type="password" name="password_again" value="<?php echo @$data['password_again'] ?>" placeholder="***********">
    </p>

    <button type="submit" name="do_signup" class = "button">Подверить</button>
</form>
    <p>У вас уже есть аккаует? <a href="login.html" color="blue">Войдите<a></p>
</div>



</body>
</html>
