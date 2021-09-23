<?php
if(!isset($_SESSION)){
    session_start();
}
if(!isset($_SESSION['UserLogin'])){
    echo header("Location: login");
}
include_once('connection.php');
    if(isset($_GET['p'])){
        $page = $_GET['p'];
    }else{
        $page = 1;
    }
    $numperpage = 05;
    $startfrom = ($page-1)*05;
$sqlStudents = "SELECT * FROM students ORDER BY student_id DESC LIMIT $startfrom, $numperpage";
$students = $conn->query($sqlStudents) or die($conn->error);
$rowStudents = $students->fetch_assoc();
$total = $students->num_rows;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- CSS only -->
<link rel="stylesheet" href="../css_files/students.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
    <title>Students</title>
</head>
<body>
    <div>
        <div class="tabs">
            <h3>Students Management System</h3>
        </div>
            <div class="buttonnav">
                <ul>
                    <li><a>Actions</a>
                        <ul>
                            <li><a class="btn text-light" href="addstudents">Add students</a></li>
                            <li><a class="btn text-light" href="addstudents">Add students</a></li>
                            <li><a class="btn text-light" href="addstudents">Add students</a></li>
                            <li><a class="btn text-light" href="addstudents">Add students</a></li>
                            <li><a class="btn text-light" href="addstudents">Add students</a></li>
                            <li><a class="btn text-light" href="addstudents">Add students</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        <div class="sidenav">
            <a href="../index"><i class="fas fa-chart-line"></i>&nbsp Dashboard</a>
            <a href="students"><i class="fas fa-user-graduate"></i>&nbsp Students</a>
            <a href="course"><i class="fas fa-graduation-cap"></i>&nbsp Course</a>
            <a href="files"><i class="far fa-folder"></i>&nbsp Folders</a>
            <a href="events"><i class="far fa-calendar-check"></i>&nbsp Events</a>
            <a href="logout"><i class="fas fa-sign-out-alt"></i> &nbsp Logout</a>
        </div>
        <form class='formSearch' action="search" method="post">
                <input type="text" name="search" id="search" placeholder="Search">
                <button type="submit" class="searchButton">Search</button>
            </form>
        <div class="studentlist">
        <div class="pagination">
            <?php
                $sqlpagination = "SELECT * FROM students";
                $querypagination = $conn->query($sqlpagination);
                $totalrecord = $querypagination->num_rows;
                $totalpage = ceil($totalrecord/$numperpage);

                if($page>1){
                    echo "<a class='m-1 btn btn-danger' href='students'><<</a>"; 
                }

                if($page>1){
                    echo "<a class='m-1 btn btn-danger' href='students?p=".($page-1)."'><</a>";
                }

                for($i = 1; $i <= $totalpage; $i++){
                  echo "<a class='m-1 btn btn-primary' href='students?p=".$i."'>$i</a>";
                }

                if($page<$totalpage){
                    echo "<a class='m-1 btn btn-danger' href='students?p=".($page+1)."'>></a>"; 
                }

                if($page<$totalpage){
                    echo "<a class='m-1 btn btn-danger' href='students?p=".($totalpage)."'>>></a>";
                }
            ?>
            </div>
            <table class='table table-hover table-bordered'>
                <thead>
                    <tr>
                        <th>Student ID</th>
                        <th>Student Name</th>
                        <th>Student Gender</th>
                        <th>Student Grade</th>
                        <th>Operations</th>
                    </tr>
                </thead>
                <tbody>
                <?php do{ ?>
                    <tr>
                        <?php if($total > 0){ ?>
                        <td><?php echo $rowStudents['student_id']; ?></td>
                        <td><?php echo $rowStudents['student_first_name']; ?></td>
                        <td><?php echo $rowStudents['student_last_name']; ?></td>
                        <td><?php echo $rowStudents['student_level']; ?></td>
                        <td width="20px"><a title="Details" href="details?id=<?php echo $rowStudents['student_id']; ?>" class="btn"><i class="fas fa-info-circle"></i></a></td>
                        <?php }else { ?> <tr><td>No record found</td></tr> <?php } ?>
                    </tr>
                <?php }while($rowStudents = $students->fetch_assoc()) ?>
                </tbody>
            </table>
            <div class="pagination">
            <?php
                $sqlpagination = "SELECT * FROM students";
                $querypagination = $conn->query($sqlpagination);
                $totalrecord = $querypagination->num_rows;
                $totalpage = ceil($totalrecord/$numperpage);

                if($page>1){
                    echo "<a class='m-1 btn btn-danger' href='students'><<</a>"; 
                }

                if($page>1){
                    echo "<a class='m-1 btn btn-danger' href='students?p=".($page-1)."'><</a>";
                }

                for($i = 1; $i <= $totalpage; $i++){
                  echo "<a class='m-1 btn btn-primary' href='students?p=".$i."'>$i</a>";
                }

                if($page<$totalpage){
                    echo "<a class='m-1 btn btn-danger' href='students?p=".($page+1)."'>></a>"; 
                }

                if($page<$totalpage){
                    echo "<a class='m-1 btn btn-danger' href='students?p=".($totalpage)."'>>></a>";
                }
            ?>
            </div>
        </div>
    </div>
</body>
</html>