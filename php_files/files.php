<?php 
if(!isset($_SESSION)){
    session_start();
}
if(!isset($_SESSION['UserLogin'])){
    echo header("Location: login");
}
//////////
include_once('connection.php');
/////////// 
$sqlFiles = "SELECT * FROM files";
$files = $conn->query($sqlFiles);
$rowFiles = $files->fetch_assoc();

$sqlModules = "SELECT * FROM files WHERE type = 'Module'";
$modules = $conn->query($sqlModules);
$rowModules = $modules->fetch_assoc();
$totalModule = $modules->num_rows;
///////////
$sqlFile = "SELECT * FROM files WHERE type = 'Other'";
$other = $conn->query($sqlFile);
$rowOther = $other->fetch_assoc();
$totalOther = $other->num_rows;
/////////////////
if(isset($_POST['submit'])){
    header("location: files");
    $title = $_POST['title'];
    $type = $_POST['type'];
    $target = "../file/".basename($_FILES['myfile']['name']);
    $file = $_FILES['myfile']['name'];
    $sqlFiles = "INSERT INTO files (title, file, type) VALUES ('$title','$file','$type')";
    $files = $conn->query($sqlFiles);
    if(move_uploaded_file($_FILES['myfile']['tmp_name'], $target)){
        $msg="success";
    }else{
        $msg="failed";
    }
}
///////////////////////////
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
    <link rel="stylesheet" href="../css_files/files.css">
    <title>Files/Modules</title>
</head>
<body>
    <div>
        <div class="tabs">
            <ul>
                <li>
                    <a class="actions">Action</a>
                    <ul>
                        <li>
                            <a class="addModules">Add Files</a>
                        </li>
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
        <div class="folder-container">
            <div class="folder">
                <b></b>
                <button class="button modulesFolder" >Modules
                    <span><?php echo $totalModule ?> items</span>
                </button>
            </div>
            <div class="folder">
                <b></b>
                <button class="button filesFolder">Files
                    <span>items</span>
                </button>
            </div>
            <div class="folder">
                <b></b>
                <button class="button othersFolder">Other
                    <span><?php echo $totalOther ?> items</span>
                </button>
            </div>
            <div class="folder">
                <b></b>
                <button class="button guideFolder">Guide</button>
            </div>
        </div>
            <div class="Modules">
                <table>
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Modules</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php do{ ?>
                        <tr>
                            <?php if ($totalModule > 0){ ?>
                            <td width="20%"><?php echo $rowModules['title'] ?></td>
                            <td width="70%"><?php echo $rowModules['file'] ?></td>
                            <td><a href="downloadfile?id=<?php echo $rowModules['id'] ?>" class="downloadButton">Download</a><a href="deletefile?id=<?php echo $rowModules['id'] ?>" class="deleteButton">Delete</a></td>
                            <?php }else { ?> <tr><td>No record found.</td></tr> <?php } ?>
                        </tr>
                        <?php } while($rowModules = $modules->fetch_assoc()) ?>
                    </tbody>
                </table>
            </div>
            <div class="Others">
                <table>
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Other Files</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php do{ ?>
                        <tr>
                            <?php if($totalOther > 0){ ?>
                            <td width="20%"><?php echo $rowOther['title'] ?></td>
                            <td width="70%"><?php echo $rowOther['file'] ?></td>
                            <td><a href="downloadfile?id=<?php echo $rowOther['id'] ?>" class="downloadButton">Download</a><a href="deletefile?id=<?php echo $rowOther['id'] ?>" class="deleteButton">Delete</a></td>
                            <?php }else{ ?> <tr><td>No record found.</td></tr> <?php } ?>
                        </tr>
                        <?php } while($rowOther = $other->fetch_assoc()) ?>
                    </tbody>
                </table>
            </div>

            <form enctype="multipart/form-data" method="post" class="addform">
                <div class="addform-content">
                    <div class="addform-header">
                        <button class="xbutton">X</button>
                    </div>
                    <div class="addform-body">
                        <input type="text" name="title" id="title" placeholder="Input Title">
                        <input type="hidden" name="size" value="100000">
                        <input type="file" name="myfile" id="file">
                        <select name="type" id="type">
                            <option value="">--Select Type--</option>
                            <option value="Module">Module</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                    <div class="addform-footer">
                        <button type="submit" class="submitbutton" name="submit">Upload</button>
                    </div>
                </div>
            </form>
    </div>
    <script src="../js_files/files.js"></script>
</body>
</html>