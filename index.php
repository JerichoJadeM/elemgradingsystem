<?php
    session_start();
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset = "utf-8">
    <meta name = "viewport" content = "width=device-width, initial-scale=1.0">
    <title>Grading System</title>
    <link rel = "stylesheet" href = "assets/css/style.modal.css">
    <link rel = "stylesheet" href = "assets/css/style.main.css">
    <link rel = "stylesheet" href = "assets/css/style.select.css">
    <style>
    /** Style everytime ne mag error ang username and password*/
        .msg-box{
            background-color: red;
            text-align: center;
            color: white;
            font-family: arial;
            font-size: 15px;
            padding: 5px;
        }
    </style>
</head>
<body>
<header>
    <h1>Elementary School Grading System</h1>
</header>
    <main>  
        <div class = "student-section">
            <h3>Student Grade Bulletin</h3>
            <iframe src="includes/student-section.php"></iframe>
        </div>
        <div class = "teacher-section">
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
                </div>
                
                <button class = "btn-pop-up" onclick="document.getElementById('id01').style.display='block'">Sign Up</button>
                    
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
        <footer>
            <div class="copyright" id="copyright">
             &copy; Copyright
                <script>
                document.getElementById('copyright').appendChild(document.createTextNode(new Date().getFullYear()))
                </script>, CC106: Jericho Jade B. Madolid || BSIT 4A IICSNIPSC. All rights reserved.
            </div>
        </footer>
    </main>
</body>
</html>