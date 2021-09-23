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
<h1>User Profile</h1>
    <form id="formInput" action="" method="post">
    <a id="backButton" class='btn btn-secondary' href="../index">Back</a>
    <br><br>
        <label for="fname">Firstname</label>
        <input disabled class='inputFields' value="<?php echo $rowUser['user_first_name']; ?>" type="text" name="fname" id="fname">
        <label for="mname">Middlename</label>
        <input disabled class='inputFields' value="<?php echo $rowUser['user_middle_name']; ?>" type="text" name="mname" id="mname">
        <label for="lname">Lastname</label>
        <input disabled class='inputFields' value="<?php echo $rowUser['user_last_name']; ?>" type="text" name="lname" id="lname">
        <label for="gender">Gender</label>
        <input disabled class='inputFields' value="<?php echo $rowUser['user_gender']; ?>" type="text" name="gender" id="gender">
        <label for="type">Type</label>
        <input disabled class='inputFields' value="<?php echo $rowUser['user_type']; ?>" type="text" name="type" id="type">
        <label for="number">Number</label>
        <input disabled class='inputFields' value="<?php echo $rowUser['user_number']; ?>" type="text" name="number" id="number">
        <label for="age">Age</label>
        <input disabled class='inputFields' value="<?php echo $rowUser['user_age']; ?>" type="text" name="age" id="age">
        <label for="email">Email</label>
        <input disabled class='inputFields' value="<?php echo $rowUser['user_email']; ?>" type="text" name="email" id="email">
        <label for="access">Access</label>
        <input disabled class='inputFields' value="<?php echo $rowUser['user_access']; ?>" type="text" name="access" id="access">
        <input disabled value="<?php echo $rowUser["id"]; ?>" type="hidden" name="id" id="id">
        <a id="updatebutton" class='btn btn-success' href="profileedit?id=<?php echo $rowUser['id']; ?>"><i class="fas fa-wrench"></i>&nbsp Update User</a>
    </form>
    <form action="" enctype="multipart/form-data" method="post" class="sideInfo">
    <input type="hidden" name="size" value="1000000000">
        <div class='imageDivision'>
            <img type="image" src="../images/<?php echo $rowUserImage['user_img']; ?>" title='../images/<?php echo $rowUserImage['user_img']; ?>' alt="">
        </div>
    </form>

</body>
</html>