<?php
if(!isset($_SESSION)){
    session_start();
}
if(!isset($_SESSION['UserLogin'])){
    echo header("Location: login");
}

include_once("connection.php");
$id = $_GET['id'];
$sqlDelete = "DELETE FROM students WHERE student_id = '$id' ";
$conn->query($sqlDelete);

$sqlDeleteImg = "DELETE FROM images WHERE image_id = '$id'";
$conn->query($sqlDeleteImg);

echo header("Location: students");

?>