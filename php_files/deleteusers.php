<?php
if(!isset($_SESSION)){
    session_start();
}
if(!isset($_SESSION['UserLogin'])){
    echo header("Location: login");
}

include_once('connection.php');
$id = $_GET['id'];

$sqlDeleteUser = "DELETE FROM user WHERE id = '$id'";
$conn->query($sqlDeleteUser);

session_start();
unset($_SESSION['UserLogin']);
echo header("Location: login");


?>