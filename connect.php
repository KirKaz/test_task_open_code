<?php
function connect(){
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
