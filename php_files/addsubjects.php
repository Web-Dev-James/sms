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
    
    ?>
    
    
    
    
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                    <a href="events"><i class="far fa-calendar-check"></i>&nbsp Events</a>
                    <a href="inventory"><i class="fas fa-warehouse"></i>&nbsp Inventory</a>
                    <a href="logout"><i class="fas fa-sign-out-alt"></i> &nbsp Logout</a>
    </div>
    <div class="main">
        <h4><?php echo $rowCourse['course_name']; ?></h4><br><hr>
        <button class="addSubject">Add Subject</button>
        <table>
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
                    <td><a class="deleteButton" onclick="if(confirm('Oops are you sure you want to delete this subject?')){location.href='deletesubject?id=<?php echo $rowSubjects['id'] ?>'}">Delete</a></td>
                    <?php } else{?><tr><td>No subjects in this area</td></tr> <?php } ?>
                </tr>
                <?php } while($rowSubjects = $subjects->fetch_assoc()) ?>
            </tbody>
        </table>
    </div>
    <form method="post" enctype="multipart/form-data" class="addSubjectDivision">
        <h3>Add Subject</h3><br><hr><br>
        <input type="hidden" disabled name="subid" value="<?php echo $rowCourse['course_id'] ?>" id="subid">
        <label for="subcode">Subject Code</label>
        <input placeholder="Example: Math 101" type="text" name="subcode" id="subcode"><br>
        <label for="subname">Subject Name</label>
        <input placeholder="Example: Algebra" type="text" name="subname" id="subname">
        <a href="addsubjects" type="submit" class="addsubject">Save</a>
        <button class="cancelSubject">Cancel</button>
    </form>
    <script>
    window.location.href="subjects?id=<?php echo $rowCourse['course_id'] ?>"
</script>
    </body>
    </html>



