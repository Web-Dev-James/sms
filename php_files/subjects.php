<?php 
if(!isset($_SESSION)){
    session_start();
}
if(!isset($_SESSION['UserLogin'])){
    echo header("Location: login");
}

include_once('connection.php');
$id = $_GET['id'];
$sqlSubjects = "SELECT * FROM subjects WHERE sub_id = '$id'";
$subjects = $conn->query($sqlSubjects);
$rowSubjects = $subjects->fetch_assoc();
$total = $subjects->num_rows;

$sqlCourse = "SELECT * FROM course WHERE course_id = '$id'";
$course = $conn->query($sqlCourse);
$rowCourse = $course->fetch_assoc();

if(isset($_POST['addsubject'])){
  header("location: subjects?id=".$id);

    $subcode = $_POST['subcode'];
    $subname = $_POST['subname'];
    $sqlAddSubject = "INSERT INTO subjects (sub_id, sub_code, sub_name) VALUES ('$id', '$subcode', '$subname')";
    $conn->query($sqlAddSubject) or die($conn->error);
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link rel="stylesheet" href="../css_files/subjects.css">
    <title><?php echo $rowCourse['course_code']; ?></title>
</head>
<body>
<div class="topnav">
        <h3>Subjects</h3>
</div>

<div class="sidenav">
                <a href="../index"><i class="fas fa-chart-line"></i>&nbsp Dashboard</a>
                <a href="students"><i class="fas fa-user-graduate"></i>&nbsp Students</a>
                <a href="course"><i class="fas fa-graduation-cap"></i>&nbsp Course</a>
                <a href="files"><i class="far fa-folder"></i>&nbsp Folders</a>
                <a href="events"><i class="far fa-calendar-check"></i>&nbsp Events</a>
                <a href="logout"><i class="fas fa-sign-out-alt"></i> &nbsp Logout</a>
</div>
<div class="main">
    <h4><?php echo $rowCourse['course_name']; ?></h4><br><hr>
    <button class="addSubject">Add Subject</button>
    <table class='table table-bordered'>
        <thead>
            <tr>
                <th>Subject Code</th>
                <th>Subject Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php do { ?>
            <tr>
                <?php if($total > 0){ ?>
                <td><?php echo $rowSubjects['sub_code'] ?></td>
                <td><?php echo $rowSubjects['sub_name'] ?></td>
                <td><a href="deletesubject?id=<?php echo $rowSubjects['id'] ?>" title="deletesubject?id=<?php echo $rowSubjects['id'] ?>" class="deleteButton">Delete</a></td>
                <?php } else{?><tr><td>No subjects in this area</td></tr> <?php } ?>
            </tr>
            <?php } while($rowSubjects = $subjects->fetch_assoc()) ?>
        </tbody>
    </table>
</div>
<form method="post" enctype="multipart/form-data" class="addSubjectDivision">
    <h3><?php echo $rowCourse['course_name'] ?></h3><br><hr><br>
    <input type="hidden" disabled name="subid" value="<?php echo $rowCourse['course_id'] ?>" id="subid">
    <label for="subcode">Subject Code</label>
    <input placeholder="Example: Math 101" type="text" name="subcode" id="subcode"><br>
    <label for="subname">Subject Name</label>
    <input placeholder="Example: Algebra" type="text" name="subname" id="subname">
    <button type="submit" name="addsubject" class="addsubject">Save</button>
    <button class="cancelSubject">Cancel</button>
</form>
<script src="../js_files/subjects.js">
</script>
</body>
</html>