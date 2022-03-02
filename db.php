<?php 

session_start();

$conn = mysqli_connect(
    'localhost',
    'root',
    '',
    'php_mysql_crud'
);

$server = 'localhost';
$username = 'root';
$password = '';
$database = 'php_login_database';

try {
    $connUser = new PDO("mysql:host=$server;dbname=$database;",$username,$password);
} catch (PDOException $e) {
    die("Conecction fail: ".$e->getMessage());
}

$connTableUsers = mysqli_connect(
    'localhost',
    'root',
    '',
    'php_login_database'
);

// Check is connected
// if (isset($conn)){
//     echo 'DB is connect';
// }

?>