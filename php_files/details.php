<?php
if(!isset($_SESSION)){
    session_start();
}
if(!isset($_SESSION['UserLogin'])){
    echo header("Location: login");
}

include_once('connection.php');
$id = $_GET['id'];
    $sql = "SELECT * FROM students WHERE student_id = '$id'";
    $students = $conn->query($sql);
    $row = $students->fetch_assoc();

$msg = '';

if(isset($_POST['submitbutton'])){
    $fname = $_POST['fname'];
    $mname = $_POST['mname'];
    $lname = $_POST['lname'];
    $level = $_POST['level'];
    $gender = $_POST['gender'];
    $age = $_POST['age'];
    $address = $_POST['address'];
    $sqlDetails = "UPDATE students SET student_first_name = '$fname', student_middle_name = '$mname', student_last_name = '$lname', student_level = '$level', student_gender = '$gender', student_age = '$age', student_address = '$address' WHERE student_id = '$id'";
    $conn->query($sqlDetails) or die ($conn->error);

    $sql = "SELECT * FROM students WHERE student_id = '$id'";
    $students = $conn->query($sql);
    $row = $students->fetch_assoc();
}

if(isset($_POST['upload'])){
        $target = "../images/".basename($_FILES['image']['name']);
        $image = $_FILES['image']['name'];
        $sqlImage = "UPDATE images SET images = '$image' WHERE image_id = '$id'";
        $conn->query($sqlImage);
        if(move_uploaded_file($_FILES['image']['tmp_name'], $target)){
            $msg="success";
        }else{
            $msg="failed";
        }
}
$sqlImageView = "SELECT * FROM images WHERE image_id = '$id'";
$images = $conn->query($sqlImageView) or die($conn->error);
$rowImages = $images->fetch_assoc();  

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
    <title><?php echo $row['student_first_name']; ?> <?php echo $row['student_last_name']; ?></title>
</head>
<body>
    <form id="formInput" action="" method="post">
    <a id="backButton" class='btn btn-secondary' href="students">Back</a>
    <br><br>
        <label for="fname">First Name</label>
        <input class='inputFields' value="<?php echo $row['student_first_name']; ?>" type="text" name="fname" id="fname">
        <label for="mname">Middle Name</label>
        <input class='inputFields' value="<?php echo $row['student_middle_name']; ?>" type="text" name="mname" id="mname">
        <label for="lname">Last Name</label>
        <input class='inputFields' value="<?php echo $row['student_last_name']; ?>" type="text" name="lname" id="lname">
        <label for="level">Grade</label>
        <input class='inputFields' value="<?php echo $row['student_level']; ?>" type="text" name="level" id="level">
        <label for="gender">Gender</label>
        <input class='inputFields' value="<?php echo $row['student_gender']; ?>" type="text" name="gender" id="gender">
        <label for="age">Age</label>
        <input class='inputFields' value="<?php echo $row['student_age']; ?>" type="text" name="age" id="age">
        <label for="address">Address</label>
        <input class='inputFields' value="<?php echo $row['student_address']; ?>" type="text" name="address" id="address">
        <input value="<?php echo $row['student_id']; ?>" type="hidden" name="id" id="id">
        <button name="submitbutton" onclick="window.location.reload()" id="submitbutton" class='btn btn-success' type="submit">Save All Changes</button>
    </form>
    <form action="" enctype="multipart/form-data" method="post" class="sideInfo">
    <input type="hidden" name="size" value="1000000000">
        <div class='imageDivision'>
        <?php do{ ?>
            <img type="image" src="../images/<?php echo $rowImages['images']; ?>" title='../images/<?php echo $rowImages['images']; ?>' alt="">
        <?php } while($rowImages = $images->fetch_assoc()) ?>
        <h4>Change</h4>
        <input required type="file" name="image" id="image">
        <button title='Save Edit' type="submit" name='upload' class="btn btn-outline-primary"><i class="far fa-paper-plane"></i></button>
        <a name="deletebutton" id="deleteButton" onclick="if(confirm('Oops are you trying to delete this student?')){location.href='deletestudents?id=<?php echo $row['student_id']; ?>'}"class="btn btn-outline-danger"><i class="fas fa-trash"></i> &nbsp Delete this Student</a>
        </div>
    </form>
    <script src="../js_files/students.js"></script>
</body>
</html>