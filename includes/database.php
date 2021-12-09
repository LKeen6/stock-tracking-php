<?php
//Development credentials
$dsn = "mysql:host=localhost;dbname=stocks";
$username = "mgs_user";
$password = "pa55word";

//Attempt to connect to the database.
try {
    $db = new PDO($dsn,$username,$password);
} catch (Exception $ex) {
    $error_message = $ex->getMessage();
    echo "<p>An error occurred while connecting to the database: $error_message</p>";
}