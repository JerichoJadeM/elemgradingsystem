<?php
    session_start();
    require 'includes/config.php';
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset = "utf-8">
    <meta name = "viewport" content = "width=device-width, initial-scale=1.0">
    <title>Grading System</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel = "stylesheet" href = "assets/css/style.modal.css">
    <link rel = "stylesheet" href = "assets/css/style.main.css">
    <link rel = "stylesheet" href = "assets/css/style.select.css">
    <style>
    /** Style everytime na mag error ang username and password*/
        .msg-box{
            background-color: red;
            text-align: center;
            color: white;
            font-family: arial;
            font-size: 15px;
            padding: 5px;
        }
    /**STYLE OF GRADES TABLE */
}
        h4{font-family: arial; padding: 5px; margin: 5px;}

        #student-table {
            font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #student-table td, #student-table th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #student-table tr:nth-child(even){background-color: #f2f2f2;}

        #student-table tr:hover {background-color: #ddd;}

        #student-table th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: center;
            background-color: forestgreen;
            color: white;
        }
        /**Style for 2nd table */
        /******************** */
        #student-card {
            font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #student-card td, #student-table th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #student-card tr:nth-child(even){background-color: #f2f2f2;}

        #student-card tr:hover {background-color: #ddd;}

        #student-card th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: center;
            background-color: darkblue;
            color: white;
        }
        .Result-box{
            width: 100%;
        }
        
    </style>
</head>
<body>
    <header>
        <h1>Elementary School Grading System</h1>
    </header>
    <main>
        <div class="container">
            <div class="row mx-auto text-center">
                <div class = "col-md-7"> <!--STUDENT DIV-->
                    <h3>Student Grade Bulletin</h3>
                    <div class="row mx-auto mt-5 mb-1">
                        <div class="col-sm-8 mb-3">
                            <form action="studentViewing.php" class="validate" method="GET">
                            <input class="form-control" name="num" placeholder="Enter your LRN" />
                        </div>
                        <div class="col-sm-4">
                            <button class="btn btn-primary mt-0" type="submit" name="Search">Search</button>
                            </form>
                        </div>
                    </div>
                    <div class="row"> <!--GRADE RESULTS-->
                    <div class = "mt-3">
                        <?php
                            function showStatus($frate){
                            $status = $frate;
                            $pass;
                        
                            if($status>=74.5){
                                $pass = "<div style = 'color: green;'><strong>PASSED</strong></div>";
                            }else{
                                $pass = "<div style = 'color: red;'><strong>FAILED</strong></div>";
                            }

                            return $pass;
                            }


                if(isset($_GET['Search'])){
                    $LRN = $_GET['num'];

                    $sql = "SELECT * FROM grades 
                        INNER JOIN students ON grades.StudentID = students.StudentID 
                        WHERE LRN_Number = '$LRN' AND Quarter = 1;";
                    $result = mysqli_query($conn, $sql);

                    if($row = mysqli_fetch_assoc($result)){
                        $fname = $row['FirstName'];
                        $lname = $row['LastName'];
                        $Mname = $row['MidInitial'];
                        $lrn_num = $row['LRN_Number'];
                        $grade = $row['GradeLevel'];
                        $section = $row['Section'];
                        
                        $eng = $row['English'];
                        $mat = $row['Math'];
                        $sci = $row['Science'];
                        $fil = $row['Filipino'];
                        $pe = $row['PE'];
                        
                        $ave = $row['Average'];
                        $id = $row['StudentID'];
                        
                
            ?>

                <table id = "table-responsive student-card mb-3">
                    <tr>
                        <th colspan = 4>Student Card</th>
                    </tr>

                    <tr>
                        <td><strong>Student Name</strong></td><td><?php echo $lname . ", " . $fname . " " . $Mname;?></td><td><strong>LRN_Number</strong></td><td><?php echo $lrn_num;?></td>
                    </tr>

                    <tr>
                        <td><strong>Grade Level</strong></td><td><?php echo $grade;?></td><td><strong>Section</strong></td><td><?php echo $section;?></td>
                    </tr>

            <?php

                $sql_rate ="SELECT AVG(Average) as final FROM grades WHERE StudentID = '$id'";
                $rate_result = mysqli_query($conn, $sql_rate);
                $row_rate = mysqli_fetch_assoc($rate_result);

                $frate = $row_rate['final'];
            ?> 

                    <tr>
                        <td><strong>General Average</strong></td><td><?php echo $frate;?></td><td><strong>Status</strong></td><td><?php echo showStatus($frate);?></td>
                    </tr>
                </table>       
            
                <table id = "student-table">
                    <tr>
                        <th rowspan = 2>Quarters</th><th colspan = 5>Subjects</th><th rowspan = 2>Rating</th>
                    </tr>
                    
                    <tr>
                        <th>English</th><th>Math</th><th>Science</th><th>Filipino</th><th>P.E</th>
                    </tr>

                    <tr>
                        <td><strong>First</strong></td><td><?php echo $eng;?></td><td><?php echo $mat;?></td><td><?php echo $sci;?></td><td><?php echo $fil;?></td><td><?php echo $pe;?></td><td><?php echo $ave;?></td>
                    </tr>
                    
            <?php }
                else{
                    echo "<div style = 'width: 100%; color: red; text-align: center;
                    font-size: 30px; font-weight: 800;line-height: 30px;'><br><br><strong>NO RECORD!</strong></div>";
                    echo "<div style = ' text-align: center; font-size:25px;'><br><strong>Please enter your correct LRN or Contact your adviser</strong></div>";
                }
            ?>

            <?php
                    
                    $sql2 = "SELECT English, Math, Science, Filipino, PE, Average FROM grades 
                        INNER JOIN students ON grades.StudentID = students.StudentID 
                        WHERE LRN_Number = '$LRN' AND Quarter = 2;";
                        $result2 = mysqli_query($conn, $sql2);
                        
                    if($row2 = mysqli_fetch_assoc($result2)){
                        $eng2 = $row2['English'];
                        $mat2 = $row2['Math'];
                        $sci2 = $row2['Science'];
                        $fil2 = $row2['Filipino'];
                        $pe2 = $row2['PE'];
                            
                        $ave2 = $row2['Average'];
            ?>
                    <tr>
                        <td><strong>Second</strong><td><?php echo $eng2;?></td><td><?php echo $mat2;?></td><td><?php echo $sci2;?></td><td><?php echo $fil2;?></td><td><?php echo $pe2;?></td><td><?php echo $ave2;?></td>
                    </tr><?php }?> 

                    <?php
                        $sql3 = "SELECT English, Math, Science, Filipino, PE, Average FROM grades 
                        INNER JOIN students ON grades.StudentID = students.StudentID 
                        WHERE LRN_Number = '$LRN' AND Quarter = 3;";
                        $result3 = mysqli_query($conn, $sql3);
                        
                        if($row3 = mysqli_fetch_assoc($result3)){
                            $eng3 = $row3['English'];
                            $mat3 = $row3['Math'];
                            $sci3 = $row3['Science'];
                            $fil3 = $row3['Filipino'];
                            $pe3 = $row3['PE'];
                            
                            $ave3 = $row2['Average'];
                    ?>
                    <tr>
                        <td><strong>Third</strong></td><td><?php echo $eng3;?></td><td><?php echo $mat3;?></td><td><?php echo $sci3;?></td><td><?php echo $fil3;?></td><td><?php echo $pe3;?></td><td><?php echo $ave3;?></td>
                    </tr><?php }?> 

                    <?php
                        $sql4 = "SELECT English, Math, Science, Filipino, PE, Average FROM grades 
                        INNER JOIN students ON grades.StudentID = students.StudentID 
                        WHERE LRN_Number = '$LRN' AND Quarter = 4;";
                        $result4 = mysqli_query($conn, $sql4);
                        
                        if($row4 = mysqli_fetch_assoc($result4)){
                            $eng4 = $row4['English'];
                            $mat4 = $row4['Math'];
                            $sci4 = $row4['Science'];
                            $fil4 = $row4['Filipino'];
                            $pe4 = $row4['PE'];
                            
                            $ave4 = $row4['Average'];
                    ?>
                    <tr>
                        <td><strong>Fourth</strong></td><td><?php echo $eng4;?></td><td><?php echo $mat4;?></td><td><?php echo $sci4;?></td><td><?php echo $fil4;?></td><td><?php echo $pe4;?></td><td><?php echo $ave4;?></td>
                    </tr><?php }?> 
                </table>
                
            <?php } mysqli_close($conn);?> 
            </div>

                    </div>
                </div>
                <div class = "col-md-5"> <!--TEACHER DIV-->
                    <h3>Teacher Portal</h3>
                    <?php
                        if(isset($_POST['login'])){
                            require 'includes/config.php';
                            
                            $Username = $_POST['username'];
                            $Password = $_POST['password'];

                            $sql = "SELECT Username, Password FROM teachers WHERE Username = '$Username' AND Password = '$Password';";
                            $result = mysqli_query($conn, $sql);
                            $row = mysqli_fetch_assoc($result);
                            $count = mysqli_num_rows($result);

                            if($count == 1){
                                $_SESSION['alogin']=$_POST['username'];

                                echo "<script type = 'text/javascript'> document.location = 'admin/index.php'; </script>";
                            }
                            else{
                                echo "<div class='msg-box'><strong>INVALID USERNAME OR PASSWORD</strong><br> Please Try Again.</div>";
                            }
                            mysqli_close($conn);
                        }
                    ?>
                    <hr />
                        <div class = "login-box">
                            <form name = "Login" method = "POST">
                                <input type = "text" name = "username" placeholder = "Enter Username" required /><br>
                                <input type = "password" name = "password" placeholder = "Enter Password" required /><br>
                                <button class = "btn-login" type = "submit" name = "login">Teacher Login</button>
                            </form>
                            <?php
                                if(isset($_POST['demoSubmit'])){
                                    $userDemo = $_POST['userDemo'];
                                    $passDemo = $_POST['passDemo'];

                                    $sql = "SELECT TeacherID FROM teachers WHERE Username='$userDemo' AND Password='$passDemo';";
                                    $result = $conn->query($sql);

                                    $row = $result->fetch_assoc();
                                    $count = $result->num_rows;

                                    if($count == 1){
                                    $_SESSION['alogin'] = $_POST['userDemo'];
                                        header('location: admin/index.php');
                                    }
                                } 
                                ?>

                                <form method="POST">
                                    <!--INPUTS FOR DEMO-->
                                    <input type="hidden" name="userDemo" value="gemma">
                                    <input type="hidden" name="passDemo" value="test1">
                                    <button name="demoSubmit" class="btn-login"><strong>Demo</strong></button>
                                </form>
                        </div>
                        
                        <button class = "btn-pop-up" onclick="document.getElementById('id01').style.display='block'">Sign Up</button>
                    </div>     
                        <div id="id01" class="modal">
                            <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">x</span>
                    
                            <form class="modal-content" action = "includes/register.php" method = "POST">
                                <div class="container">
                                    <h3>Teacher Sign Up</h3>
                                    <p>Please fill in this form to create an account.</p>
                                    <hr>
                                    <label for="firstname"><b>First Name</b></label>
                                <input type="text" placeholder="Enter First Name" name="firstname" required>

                                <label for="middlename"><b>Middle Name</b></label>
                                <input type="text" placeholder="Enter Middle Name" name="midname" required>

                                <label for="lastname"><b>Last Name</b></label>
                                <input type="text" placeholder="Enter Last Name" name="lastname" required>

                                <label for="GradeLevel"><b>Grade Level</b></label>
                                <div class = "custom-select" style = "width:200px;">
                                <select name="gradelevel">
                                    <option value = "0">Select Grade</option>
                                    <option value = "1">Grade 1</option>
                                    <option value = "2">Grade 2</option>
                                    <option value = "3">Grade 3</option>
                                    <option value = "4">Grade 4</option>
                                    <option value = "5">Grade 5</option>
                                    <option value = "6">Grade 6</option>
                                </select></div>

                                <label for="Section"><b>Section</b></label>
                                <input type="text" placeholder="Enter Section you handle" name="section" required>

                                <label for="username"><b>User Name</b></label>
                                <input type="text" placeholder="Enter desired username" name="username" required>

                                <label for="psw"><b>Password</b></label>
                                <input type="password" placeholder="Enter Password" name="psw" required>

                                <label for="psw-repeat"><b>Repeat Password</b></label>
                                <input type="password" placeholder="Repeat Password" name="repsw" required>

                                <div class="clearfix">
                                    <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
                                    <button class = "signupbtn" type="submit" class="signup" name = "signup">Sign Up</button>  
                                    </div>
                        </div>
                            </form>
                                </div>
        
                <script src = "assets/js/select.js"></script>
                <script src="assets/js/modal.js"></script>
            </div>
        </div>
        <div class="footer">
            <div class="copyright" id="copyright">
             &copy; Copyright
                <script>
                document.getElementById('copyright').appendChild(document.createTextNode(new Date().getFullYear()))
                </script>Jericho Jade B. Madolid || All rights reserved.
            </div>
        </div>
    </main>
<script src="assets/js/bootstrap.min.js"></script>
</body>
</html>