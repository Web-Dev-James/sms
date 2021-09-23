<?php

if(!isset($_SESSION)){
    session_start();
}
if(isset($_SESSION['UserLogin'])){
echo header("Location: ../index");
}
include_once('connection.php');
if(isset($_POST['login'])){
    $username = $_POST['Username'];
    $pass = $_POST['Password'];
    $sqlUser = "SELECT * FROM user WHERE user_email = '$username' AND user_password = '$pass'";
    $users = $conn->query($sqlUser);
    $rowUsers = $users->fetch_assoc();
    $total = $users->num_rows;
    if($total > 0){
        $_SESSION['UserLogin'] = $rowUsers['user_email'];
        $_SESSION['UserID'] = $rowUsers['id'];
        $_SESSION['UserFirstName'] = $rowUsers['user_first_name'];
        $_SESSION['UserLastName'] = $rowUsers['user_last_name'];
        $_SESSION['Access'] = $rowUsers['user_access'];

        echo header("Location: ../index");
    }else{
        echo "<span class='spanInvalid'>Invalid Credentials</span>";
    }
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
    <link rel="stylesheet" href="../css_files/login.css">
    <title>Login Account</title>
</head>
<body><br>
        <form class="formLogin" action="" method="post">
            <br><br>
            <h1 class='text-center'>Login User</h1>
            <br><br>
            <input type="email" name="Username" id="username" placeholder="Email">
            <input type="password" name="Password" id="password" placeholder="Password">
            <button name="login" type="submit" class="btn loginbutton"><i class="fas fa-sign-in-alt"></i> &nbsp Login</button>
            <a href="register.php" class="btn registerbutton"><i class="fas fa-user-plus"></i> &nbsp New user</a>
        </form>
</body>
</html>