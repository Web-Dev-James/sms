<?php
if(!isset($_SESSION)){
    session_start();
}
if(!isset($_SESSION['UserLogin'])){
    echo header("Location: php_files/login");
}

include_once('php_files/connection.php');
    $sqlStudents = "SELECT COUNT(student_id) as summaryStudents FROM students";
    $students = $conn->query($sqlStudents) or die ($conn->error);
    $rowStudents = $students->fetch_assoc();

    $sqlUsers = "SELECT COUNT(id) as summaryUsers FROM user";
    $users = $conn->query($sqlUsers) or die ($conn->error);
    $rowUsers = $users->fetch_assoc();

    $sqlEvents = "SELECT * FROM events ORDER BY event_id DESC LIMIT 3";
    $events = $conn->query($sqlEvents) or die ($conn->error);
    $rowEvents = $events->fetch_assoc();

    $sqlNonTeaching = "SELECT COUNT(user_type) as totalNonTeaching FROM user WHERE user_type = 'non-teaching'";
    $nonTeaching = $conn->query($sqlNonTeaching) or die ($conn->error);
    $rowNonTeaching = $nonTeaching->fetch_assoc();

    $sqlTeaching = "SELECT COUNT(user_type) as totalTeaching FROM user WHERE user_type = 'teaching'";
    $teaching = $conn->query($sqlTeaching) or die ($conn->error);
    $rowTeaching = $teaching->fetch_assoc();

    $sqlUser = "SELECT * FROM user";
    $users = $conn->query($sqlUser);
    $rowUser = $users->fetch_assoc();

    $userID = $_SESSION['UserID'];
    $sqlUserImage = "SELECT * FROM user_images WHERE user_img_id = '$userID'";
    $userImage = $conn->query($sqlUserImage) or die($conn->error);
    $rowUserImage = $userImage->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
<link rel="stylesheet" href="./css_files/index.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
    <title>Dashboard</title>
</head>
<body>
 <div class="container-fluid">
    <h1 class='dashboard text-center'>Dashboard</h1>
    <br><br>
        <div class="sidenav">
            <span class="welcome">Welcome</span>
               <?php if(isset($_SESSION['UserLogin'])){?>
                <?php do{ ?>
                    <input type="hidden" name="userID" value = "<?php echo $_SESSION['UserID']; ?>">
                <input type="image" src="images/<?php echo $rowUserImage['user_img']; ?>" title="images/<?php echo $rowUserImage['user_img']; ?>" alt="">
                <?php } while($rowUserImage = $userImage->fetch_assoc()) ?>
            <a href="php_files/profile?id=<?php echo $_SESSION['UserID']; ?>" class="name"><?php echo $_SESSION['UserFirstName']. "  " . $_SESSION['UserLastName']; } ?></a>
            <a href="php_files/logout"><i class="fas fa-sign-out-alt"></i> &nbsp Logout</a>
            <br>
            <a href="index"><i class="fas fa-chart-line"></i>&nbsp Dashboard</a>
            <a href="php_files/students"><i class="fas fa-user-graduate"></i>&nbsp Students</a>
            <a href="php_files/course"><i class="fas fa-graduation-cap"></i>&nbsp Course</a>
            <a href="php_files/files"><i class="far fa-folder"></i>&nbsp Folders</a>
            <a href="php_files/events"><i class="far fa-calendar-check"></i>&nbsp Events</a>
            <a href="php_files/inventory"><i class="fas fa-warehouse"></i>&nbsp Inventory</a>
        </div>
        <div class="grid-item">
            <div class="grid grid-totalUsers">
                <h6><svg stroke="currentColor" fill="none" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg> &nbsp Total Users</h6>
                    <span><?php echo $rowUsers['summaryUsers']; ?></span>
            </div>
            
            <div class="grid grid-totalStudents">
            <h6><svg stroke="currentColor" fill="none" stroke-width="0" viewBox="0 0 24 24" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg> &nbsp Total Students</h6 >
                <span><?php echo $rowStudents['summaryStudents']; ?></span>
            </div>
            <div class="grid grid-totalTeachingStaff">
            <h6><svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 640 512" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><path d="M208 352c-2.39 0-4.78.35-7.06 1.09C187.98 357.3 174.35 360 160 360c-14.35 0-27.98-2.7-40.95-6.91-2.28-.74-4.66-1.09-7.05-1.09C49.94 352-.33 402.48 0 464.62.14 490.88 21.73 512 48 512h224c26.27 0 47.86-21.12 48-47.38.33-62.14-49.94-112.62-112-112.62zm-48-32c53.02 0 96-42.98 96-96s-42.98-96-96-96-96 42.98-96 96 42.98 96 96 96zM592 0H208c-26.47 0-48 22.25-48 49.59V96c23.42 0 45.1 6.78 64 17.8V64h352v288h-64v-64H384v64h-76.24c19.1 16.69 33.12 38.73 39.69 64H592c26.47 0 48-22.25 48-49.59V49.59C640 22.25 618.47 0 592 0z"></path></svg> &nbsp Total Teaching</h6 >
                <span><?php echo $rowTeaching['totalTeaching']; ?></span>
            </div>
            <div class="grid grid-totalNonTeachingStaff">
            <h6><svg stroke="currentColor" fill="none" stroke-width="0" viewBox="0 0 24 24" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg> &nbsp Total Non-Teaching</h6 >
                <span><?php echo $rowNonTeaching['totalNonTeaching']; ?></span>
            </div>
        </div>
    </div>
    <br><br><br><br><br>
        <div class="container-fluid eventDashboard">
        <h2>Latest from Events</h2>
        <?php do { ?>
                <span><strong><?php echo $rowEvents['event_title'] ?></strong> | <?php echo $rowEvents['date'] ?><br><br><?php  echo $rowEvents['event_body']?></span><br><br><hr>
                <?php } while($rowEvents = $events->fetch_assoc()) ?>
    </div>
</body>
</html>