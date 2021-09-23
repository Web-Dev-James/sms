<?php
if(!isset($_SESSION)){
    session_start();
}
if(!isset($_SESSION['UserLogin'])){
    echo header("Location: login");
}

include_once('connection.php');
$msg='';
    if(isset($_POST['register'])){
        $fname = $_POST['fname'];
        $mname = $_POST['mname'];
        $lname = $_POST['lname'];
        $gender = $_POST['gender'];
        $type = $_POST['type'];
        $number = $_POST['number'];
        $age = $_POST['age'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $access = $_POST['access'];

        $sqlRegister = "INSERT INTO user (user_first_name, user_middle_name, user_last_name, user_gender, user_type, user_number, user_age, user_email, user_password, user_access) VALUES ('$fname','$mname','$lname','$gender','$type','$number','$age','$email', '$password', '$access')";
        $conn->query($sqlRegister) or die ($conn->error);

        $target = "../images/".basename($_FILES['imageUser']['name']);
        $userImage = $_FILES['imageUser']['name'];

        $sqlUserImage =" INSERT INTO user_images (user_img) VALUES ('$userImage')";
        $conn->query($sqlUserImage);
        if(move_uploaded_file($_FILES['userImages']['tmp_name'], $target)){
            $msg = "Success";
        }else{
            $msg = "Error"; 
        }
        echo header("Location: login");
        setcookie("fname", $fname, time() + (86400*30), "/");
        setcookie("mname", $mname, time() + (86400*30), "/");
        setcookie("lname", $lname, time() + (86400*30), "/");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
    <link rel="stylesheet" href="../css_files/register.css">
    <title>Register Account</title>
</head>
<body><br>
        <form class="formLogin" enctype="multipart/form-data" action="" method="post">
            <br><br>
            <h1 class='text-center'>Register User</h1>
            <br><br>
            <input required type="hidden" name="size" value="1000000">
            <input required type="file" name="imageUser" id="imageUser">
            <input required type="text" placeholder="First Name" name="fname" class="" id="fname">
            <input required type="text" placeholder="Middle Name" name="mname" class="" id="mname">
            <input required type="text" placeholder="Last Name" name="lname" class="" id="lname">
            <select name="gender" class="" id="gender">
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select>
            <select name="type" class="" id="type">
                <option value="Teaching">Teaching</option>
                <option value="Non-Teaching">Non-Teaching</option>
            </select>   
            <input required type="text" placeholder="Number" name="number" class="" id="number">
            <input required type="text" placeholder="Age" name="age" class="" id="age">
            <input required type="email" placeholder="Email" name="email" class="" id="email">
            <input required type="password" placeholder="Password" name="password" class="" id="password">
            <select name="access" class="" id="access">
                <option value="Administrator">Administrator</option>
                <option value="Student">Student</option>
            </select>
            <button name="register" type="submit" class="btn loginbutton"><i class="fas fa-user-plus"></i> &nbsp Register</button>
            <a href="login" class="btn registerbutton"><i class="fas fa-sign-in-alt"></i> &nbsp Back to Login</a>
        </form>
</body>
</html>