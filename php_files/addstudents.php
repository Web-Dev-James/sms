<?php
if(!isset($_SESSION)){
    session_start();
}
if(!isset($_SESSION['UserLogin'])){
    echo header("Location: login");
}

include_once('connection.php');
$msg = '';
if(isset($_POST['submitbutton'])){
        $target = "../images/".basename($_FILES['image']['name']);
        $image = $_FILES['image']['name'];
        $sqlImage = "INSERT INTO images (images) VALUES ('$image')";
        $conn->query($sqlImage);
        if(move_uploaded_file($_FILES['image']['tmp_name'], $target)){
            $msg="success";
        }else{
            $msg="failed";
        }
        $fname = $_POST['fname'];
        $mname = $_POST['mname'];
        $lname = $_POST['lname'];
        $level = $_POST['level'];
        $gender = $_POST['gender'];
        $age = $_POST['age'];
        $address = $_POST['address'];
        $sqlAddStudent = "INSERT INTO students (student_first_name, student_middle_name, student_last_name, student_level, student_gender, student_age, student_address) VALUES ('$fname','$mname','$lname','$level','$gender','$age','$address')";
        $conn->query($sqlAddStudent) or die($conn->error);
        echo header("Location: students");
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
<link rel="stylesheet" href="../css_files/students.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
    <title>Add Student</title>
</head>
<body>
    <form action=""  enctype="multipart/form-data" method="post">
        <div id="formInput">
        <a id="backButton" class='btn btn-secondary' href="students">Back</a>
    <br><br>
        <label for="fname">First Name</label>
        <input class='inputFields' value="" type="text" name="fname" id="fname">
        <label for="mname">Middle Name</label>
        <input class='inputFields' value="" type="text" name="mname" id="mname">
        <label for="lname">Last Name</label>
        <input class='inputFields' value="" type="text" name="lname" id="lname">
        <label for="level">Grade</label>
        <input class='inputFields' value="" type="text" name="level" id="level">
        <label for="gender">Gender</label>
        <select class="inputFields" name="gender" id="gender">
            <option value="Male">Male</option>
            <option value="Female">Female</option>
        </select>
        <label for="age">Age</label>
        <input class='inputFields' value="" type="text" name="age" id="age">
        <label for="address">Address</label>
        <input class='inputFields' value="" type="text" name="address" id="address">
        </div>
        <div class="sideInfo">
        <input type="hidden" name="size" value="1000000000">
        <div class='imageDivision'>
        <input type="file" name="image" id="image">
        </div>
        </div>
        <button name="submitbutton" id="submitbuttonadd" class='btn btn-success' type="submit">Save All</button>
    </form>

</body>
</html>