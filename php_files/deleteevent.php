<?php
if(!isset($_SESSION)){
    session_start();
}
if(!isset($_SESSION['UserLogin'])){
    echo header("Location: login");
}

include_once('connection.php');
$id = $_GET['id'];

$sqlDeleteEvent = "DELETE FROM events WHERE event_id = '$id'";
$conn->query($sqlDeleteEvent);
header("location: events");
?>