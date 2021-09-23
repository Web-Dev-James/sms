<?php
include_once("connection.php");
$id = $_GET['id'];
$sqlDelete = "DELETE FROM files WHERE id = '$id'";
$delete = $conn->query($sqlDelete);
header("location: files");
?>