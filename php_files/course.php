<?php
if(!isset($_SESSION)){
    session_start();
}
if(!isset($_SESSION['UserLogin'])){
    echo header("Location: login");
}

include_once('connection.php');
$sqlCourse="SELECT * FROM course";
$course = $conn->query($sqlCourse);
$rowCourse=$course->fetch_assoc();

$sqlSubjects = "SELECT * FROM subjects";
$subjects = $conn->query($sqlSubjects);
$rowSubjects = $subjects->fetch_assoc();

if(isset($_POST['submitCourse'])){
    $coursecode = $_POST['coursecode'];
    $coursename = $_POST['coursename'];
    $coursediff = $_POST['coursedifficulty'];

    $sqladdCourse = "INSERT INTO course (course_code, course_name, course_difficulty) VALUES ('$coursecode','$coursename','$coursediff')";
    $conn->query($sqladdCourse);
    echo header('location: course');    
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css_files/course.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
    <title>Course</title>
</head>
<body>
<div class="">
    <div class="topnav">
        <h4>Course</h4>
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
            <h3>Welcome Admin <?php echo $_SESSION['UserFirstName']. " " . $_SESSION['UserLastName']; ?></h3>
            <hr>
            <button class="addCourse">Add Course</button>
            <table class='table table-hover table-bordered'>
                <thead>
                    <tr>
                        <th>Course Code</th>
                        <th>Course Name</th>
                        <th>Course Difficulty</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php do{ ?>
                    <tr>
                        <td><?php echo $rowCourse['course_code'] ?></td>
                        <td><?php echo $rowCourse['course_name'] ?></td>
                        <td><?php echo $rowCourse['course_difficulty'] ?></td>
                        <td><a class="subjects text-dark" href="subjects?id=<?php echo $rowCourse['course_id']; ?>">Subjects</a></td>
                    </tr>
                <?php } while($rowCourse = $course->fetch_assoc()) ?>
                </tbody>
            </table>
        </div>
        <div class="addcourseDivision">
            <h1>Add course</h1><hr>
            <br>
            <form action="" method="post">
                <label for="">Course Code</label><input type="text" required name="coursecode" id="coursecode" placeholder="Example: BSIT"><br>
                <label for="">Course Name</label><input type="text"required name="coursename" id="coursename" placeholder="Example: Bachelor of Science in Information Technology"><br>
                <label for="">Course Difficulty</label><select required name="coursedifficulty" id="coursedifficulty">
                    <option value="Very Easy">Very Easy</option>
                    <option value="Easy">Easy</option>
                    <option value="Medium">Medium</option>
                    <option value="Hard">Hard</option>
                    <option value="Very Hard">Very Hard</option>
                </select><br>
                <button type="submit" class="saveCourse" name="submitCourse">Save</button>
                <button class="cancelCourse">Cancel</button>
            </form>
        </div>
<script src="../js_files/course.js"></script>
</body>
</html>