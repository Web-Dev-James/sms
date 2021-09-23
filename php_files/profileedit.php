<?php
if(!isset($_SESSION)){
    session_start();
}
if(!isset($_SESSION['UserLogin'])){
    echo header("Location: login");
}

include_once('connection.php');
$id = $_GET['id'];

    $sqlUser = "SELECT * FROM user WHERE id ='$id'";
    $users = $conn->query($sqlUser);
    $rowUser = $users->fetch_assoc();

$msg = '';

if(isset($_POST['submitbutton'])){
    echo header("Location: profile?id=".$id);
        $fname = $_POST['fname'];
        $mname = $_POST['mname'];
        $lname = $_POST['lname'];
        $gender = $_POST['gender'];
        $type = $_POST['type'];
        $number = $_POST['number'];
        $age = $_POST['age'];
        $email = $_POST['email'];
        $access = $_POST['access'];
        $sqlUpdateUser = "UPDATE user SET user_first_name = '$fname',user_middle_name = '$mname', user_last_name = '$lname', user_gender = '$gender', user_type = '$type', user_number = '$number', user_age = '$age', user_email = '$email', user_access = '$access' WHERE id = '$id'";
        $userUpdate = $conn->query($sqlUpdateUser);

        $sqlUser = "SELECT * FROM user WHERE id ='$id'";
        $users = $conn->query($sqlUser);
        $rowUser = $users->fetch_assoc();
}

if(isset($_POST['uploadImage'])){
    $target = "../images/".basename($_FILES['userpicture']['name']);
    $userImage = $_FILES['userpicture']['name'];
    $sqlImage = "UPDATE user_images SET user_img = '$userImage' WHERE user_img_id = '$id'";
    $conn->query($sqlImage);
    if(move_uploaded_file($_FILES['userpicture']['tmp_name'], $target)){
        $msg = 'Success';
    }else{
        $msg = "Error";
    }
}

$sqlUserImage = "SELECT * FROM user_images WHERE user_img_id = '$id'";
$userImage = $conn->query($sqlUserImage);
$rowUserImage = $userImage->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
<link rel="stylesheet" href="../css_files/profile.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
    <title><?php echo $_SESSION['UserFirstName']; ?> <?php echo $_SESSION['UserLastName']; ?></title>
</head>
<body>
<h1>User Update</h1>
    <form id="formInput" action="" method="post">
    <a id="backButton" class='btn btn-secondary' href="profile?id=<?php echo $rowUser['id'] ?>">Back</a>
    <br><br>
        <label for="fname">Firstname</label>
        <input class='inputFields' value="<?php echo $rowUser['user_first_name']; ?>" type="text" name="fname" id="fname">
        <label for="mname">Middlename</label>
        <input class='inputFields' value="<?php echo $rowUser['user_middle_name']; ?>" type="text" name="mname" id="mname">
        <label for="lname">Lastname</label>
        <input class='inputFields' value="<?php echo $rowUser['user_last_name']; ?>" type="text" name="lname" id="lname">
        <label for="gender">Gender</label>
        <input class='inputFields' value="<?php echo $rowUser['user_gender']; ?>" type="text" name="gender" id="gender">
        <label for="type">Type</label>
        <input class='inputFields' value="<?php echo $rowUser['user_type']; ?>" type="text" name="type" id="type">
        <label for="number">Number</label>
        <input class='inputFields' value="<?php echo $rowUser['user_number']; ?>" type="text" name="number" id="number">
        <label for="age">Age</label>
        <input class='inputFields' value="<?php echo $rowUser['user_age']; ?>" type="text" name="age" id="age">
        <label for="email">Email</label>
        <input class='inputFields' value="<?php echo $rowUser['user_email']; ?>" type="text" name="email" id="email">
        <label for="access">Access</label>
        <input class='inputFields' value="<?php echo $rowUser['user_access']; ?>" type="text" name="access" id="access">
        <input value="<?php echo $rowUser["id"]; ?>" type="hidden" name="id" id="id">
        <button name="submitbutton" id="submitbutton" onclick="window.location.reload()" class='btn btn-success' type="submit">Save All Changes</button>
    </form>
    <form action="" enctype="multipart/form-data" method="post" class="sideInfo">
    <input type="hidden" name="size" value="1000000000">
        <div class='imageDivision'>
            <img type="image" src="../images/<?php echo $rowUserImage['user_img']; ?>" title='../images/<?php echo $rowUserImage['user_img']; ?>' alt="">
        <h4>Change</h4>
        <input required type="file" name="userpicture" id="image">
        <button title='Save Edit' type="submit" name='uploadImage' class="btn btn-outline-primary"><i class="far fa-paper-plane"></i></button>
        </div>
        <a id="deleteButton" onclick="if(confirm('Oops. Are you trying to delete this user?')){window.location.href='deleteusers?id=<?php echo $rowUser['id']; ?>'}" class="btn btn-danger"><i class="fas fa-trash"></i> &nbsp Delete User</a>
    </form>
    <script src="../js_files/profileedit.js"></script>
</body>
</html>