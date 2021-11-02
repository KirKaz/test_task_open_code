
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
session_start();

if(isset($_POST['do_login'])) {

    $select_data = pg_query($connection, "SELECT * FROM users WHERE mail='$_POST[email]' AND pass='$_POST[password]'");
    $user = pg_fetch_assoc($select_data);
    if ($user) {
        $_SESSION['logged_user'] = $user;

        echo "success";
    } else {
        echo "fail";

    }
    exit();
}

