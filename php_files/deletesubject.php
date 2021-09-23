<?php 
if(!isset($_SESSION)){
    session_start();
}
if(!isset($_SESSION['UserLogin'])){
    echo header("Location: login");
}

include_once('connection.php');
$id = $_GET['id'];

$sqlCourse = "SELECT * FROM subjects WHERE id = '$id'";
$course = $conn->query($sqlCourse);
$rowSub = $course->fetch_assoc();

header("location: subjects?id=".$rowSub['sub_id']);

$sqlDelete = "DELETE FROM subjects WHERE id = '$id'";
$conn->query($sqlDelete);
?>

<script>
</script>