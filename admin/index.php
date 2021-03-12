<?php
    include("../includes/config.php");
    session_start();
    if(strlen($_SESSION['alogin'])==0){
        header('location: ../index.php?error=You_Must_Register_or_Login_To_The_Teacher_Portal.');
    }
    else{
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grading System||Teacher Portal</title>

    <link rel = "stylesheet" href = "assets/css/font-awesome.css">
    <link rel = "stylesheet" href = "assets/css/style.admin.css">
    <link rel = "stylesheet" href = "../assets/css/style.modal.css">
    <link rel = "stylesheet" href = "assets/css/modal.logout.css">

    <link rel="stylesheet" type="text/css" href="libraries/DataTables/datatables.css">
    <script src = "libraries/Plugins/datatable.plugin.jquery.js"></script>
    <script src="libraries/DataTables/datatables.js"></script>
</head>
<body>
    <div class = "wrapper">
        <nav>
            <header>
                <span></span>
                   Teacher Portal
            </header>
            <ul>
                <li><span>Navigation</span></li>
                <li><a class = "active" href = "index.php">Students</a></li>
                <li><a href = "post-grades.php">Update Grades</a></li>
                <li><a href = "my-profile.php">Manage Records</a></li>
                <li><span>Other</span></li>
                <li><a href = "https://web.facebook.com/aegon.madolid/" target = "_blank">Follow Developer</a></li>
                <li><a href = "change-password.php">Change Password</a></li>
                <li><a href = "#openModal">Log Out</a>
                    <div id="openModal" class="modalDialog">
                        <div>
                            <h2>ATTENTION!</h2>
                            <p>You are about to log out. If you wish to remain logged in, click the cancel button. If not click proceed button.</p>
                            <form action = "logout.php" method = "POST">
                            <div class="clearfix">
                                <button type="button" onclick="window.location.href = 'index.php';" class="cancelbtn">Cancel</button>
                                <button class = "signupbtn" type="submit" class="signup" name = "logout">Proceed</button>  
                            </div>
                            </form>
                        </div>
                    </div>
                </li>
            </ul>
        </nav>
        <main>
            <?php
                $name = $_SESSION['alogin'];
                $NameTag = "SELECT FirstName, LastName, GradeLevel, Section FROM teachers WHERE Username = '$name';";
                $NameResult = mysqli_query($conn, $NameTag);
                $rowName = mysqli_fetch_assoc($NameResult);
                
                $gradelevel = $rowName['GradeLevel'];
                $section = $rowName['Section'];
            ?>
            <h1>Welcome! Teacher <?php echo $rowName['FirstName'] . " " . $rowName['LastName'];?></h1>
                <div class = "contents">
                <div> <h2>Student <strong>General Average </strong>is computed from <strong>First Grading to Fourth Grading Period</strong></h2>
            <table id="myTable" class="hover">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>LRN Number</th>
                    <th>Student Name</th>
                    <th>Grade Level</th>
                    <th>Section</th>
                    <th>General Ave</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
          <?php
            function showStatus($rating){
                $status = $rating;
                $pass;
                
                if($status>=74.5){
                    $pass = "<div style = 'color: green;'><strong>PASSED</strong></div>";
                }else{
                    $pass = "<div style = 'color: red;'><strong>FAILED</strong></div>";
                }
                return $pass;
            }

            $sql = "SELECT Username, LRN_Number,students.StudentID, students.FirstName, students.MidInitial, students.LastName, students.GradeLevel, students.Section, Average, Quarter 
            from grades INNER JOIN students on grades.StudentID = students.StudentID 
            INNER JOIN teachers on grades.TeacherID = teachers.TeacherID WHERE Username = '$name';";
            $result = mysqli_query($conn, $sql);
            
            $count = 1;
            while($row = mysqli_fetch_assoc($result)){
                $id = $row['StudentID'];

                $sql_rate ="SELECT AVG(Average) as final FROM grades WHERE StudentID = '$id'";
                 $rate_result = mysqli_query($conn, $sql_rate);
                 $row_rate = mysqli_fetch_assoc($rate_result);
 
                 $rating = $row_rate['final'];
          ?>
          <tr>
              <td style = "text-align: center;"><?php echo $count?></td>
              <td style = "text-align: left;"><?php echo $row['LRN_Number'];?></td>
              <td style = "text-align: left;"><?php echo $row['LastName'] . ", " . $row['FirstName'] . " " . $row['MidInitial'];?></td>
              <td style = "text-align: center;"><?php echo $row['GradeLevel'];?></td>
              <td style = "text-align: center;"><?php echo $row['Section'];?></td>
              <td style = "text-align: center;"><?php echo $rating;?></td>
              <td style = "text-align: center;"><?php echo showStatus($rating);?></td>
          </tr>
        <?php $count++ ;} ?>
      </tbody>
      <tfoot>
                <tr>
                    <th>No.</th>
                    <th>LRN Number</th>
                    <th>Student Name</th>
                    <th>Grade Level</th>
                    <th>Section</th>
                    <th>Average</th>
                    <th>Status</th>
                </tr>
            </tfoot>
    </table>
    <script>
      $(document).ready( function () {
    $('#myTable').DataTable();
    } );
    </script>
                </div>   
            </div>
        </main>
    </div>
    <script>
        var modal = document.getElementById('openModal');
            window.onclick = function(event) {
                if (event.target == modal) {
                modal.style.display = "none";
                document.location = "index.php";
            }
        }
    </script>
</body>
</html>
<?php mysqli_close($conn);} ?>