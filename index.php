<?php
session_start();
if (isset($_SESSION['logged_user'])){
$user = $_SESSION['logged_user'];
echo "<div class='form_div'>";
echo "<h2>Добро пожаловать, $user[name]</h2>";
echo "<form method='post' action='list.php'>";
echo "<input class='button' type='submit' name='logout' value='Просмотр новостей'>";
echo "</form></div>";
}
else{
    echo 'Пожалуйста, <a href = login.html>войдите</a> в систему';
}
