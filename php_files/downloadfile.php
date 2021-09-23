<?php
include_once('connection.php');
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = "SELECT * from files where id = '$id'";
    $result = mysqli_query($conn, $sql);
    $file = mysqli_fetch_assoc($result);
    $filepath = '../file/'.$file['file'];
    if(file_exists($filepath)){
        header("Content-Type: application/octet-stream");
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename =".basename($filepath));
        header("Expires: 0");
        header("Cache-Control: must-revalidate");
        header("Pragma: public");
        header("Content-Length:".filesize("../file/".$file['file']));
        readfile('../file/'.$file['file']);
        exit;
    }
}
?>