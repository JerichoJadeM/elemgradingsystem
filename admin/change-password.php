<?php
    include("../includes/config.php");
    session_start();
    if(strlen($_SESSION['alogin'])==0){
        header('location: ../index.php');
    }
    else{
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grading System||Teacher Portal</title>
    <link rel = "stylesheet" href = "assets/css/style.admin.css">
    <link rel = "stylesheet" href = "../assets/css/style.modal.css">
    <link rel = "stylesheet" href = "assets/css/modal.logout.css">
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
                <li><a href = "index.php">Students</a></li>
                <li><a href = "post-grades.php">Post Grades</a></li>
                <li><a href = "my-profile.php">My Profile</a></li>
                <li><span>Other</span></li>
                <li><a href = "https://web.facebook.com/aegon.madolid/" target = "_blank">Follow Developer</a></li>
                <li><a class = "active" href = "change-password.php">Change Password</a></li>
                <li><a href = "#openModal">Log Out</a>
                    <div id="openModal" class="modalDialog">
                        <div>
                            <h2>ATTENTION!</h2>
                            <p>You are about to log out. If you wish to remain logged in, click the cancel button. If not click proceed button.</p>
                            <form action = "logout.php" method = "POST">
                                <div class="clearfix">
                                    <button type="button" onclick="window.location.href = 'change-password.php';" class="cancelbtn">Cancel</button>
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
                $NameTag = "SELECT FirstName, LastName FROM teachers WHERE Username = '$name';";
                $NameResult = mysqli_query($conn, $NameTag);
                $rowName = mysqli_fetch_assoc($NameResult);            
            ?>
            <h1>Welcome! Teacher <?php echo $rowName['FirstName'] . " " . $rowName['LastName'];?></h1>
            <div class = "contents">
               <div>
                  <h2>You're about to change your password, action cannot undo.</h2>
                  <?php
                    if(isset($_POST['ChangePass'])){
                        $sqlShowPass = "SELECT Password FROM teachers WHERE Username = '$name';";
                        $ShowResult = mysqli_query($conn, $sqlShowPass);
                        $PassCheck = mysqli_fetch_assoc($ShowResult);

                        $OldPass = $PassCheck['Password'];
                        if($PassCheck['Password']==$_POST['oldpass']){

                        $NewPass = $_POST['newpass'];
                        $ConfirmPass = $_POST['confirmpass'];

                        if($_POST['newpass']==$_POST['confirmpass']){
                            $PasswordUpdate = "UPDATE teachers SET Password = '$NewPass' WHERE Username = '$name' AND Password = '$OldPass';";
                           
                            if($UpdateResult = mysqli_query($conn, $PasswordUpdate)){
                                Echo "<h3 style = 'color:green; text-align:center;'>Password Changed Succesfully!</h3>";
                            }
                            else{
                                Echo "<h3 style = 'color:red; text-align:center;'>Error Changing Password, Please Try again.</h3>";
                            }
                        }
                        else{
                            echo "<h3 style = 'color:red; text-align:center;'>New Password did not match. Try Again.</h3>";
                        } 
                    }
                    else{
                        Echo "<h3 style = 'color:red; text-align:center;'>Your Old Password is wrong, Please enter correct password.</h3>";
                    }
                    mysqli_close($conn);
                }
            ?>
                    <h3 style = "text-align:center; line-height: 25px;">Change Password</h3></span>
                    <form name = "ChangePassword" method = "POST">
                        <table style = "width:500px;">
                            <tr>
                                <td>Old Password: </td><td><input type = "password" name = "oldpass" placeholder = "Enter your old Password" /></td>
                            </tr>
                            <tr>
                                <td>New Password: </td><td><input type = "password" name = "newpass" placeholder = "Enter your New Password" /></td>
                            </tr>
                            <tr>
                                <td>Confirm New Password: </td><td><input type = "password" name = "confirmpass" placeholder = "Verify your New Password" /></td>
                            </tr>
                            <tr>
                                <td colspan = 2>
                                <div class="clearfix">
                                <button type="button" onclick="window.location.href = 'index.php';" class="cancelbtn">Cancel</button>
                                <button class = "signupbtn" type="submit" name = "ChangePass">Save Password</button>  
                                </div>
                                </td>
                            </tr>
                        </table>
                    </form>
               </div>
               <div>
                  <img src = "assets/img/caution-emoji.gif" width = "250px">
                  <img src = "assets/img/key.png" width = "250px" height = "250px">
                    <h3 style = "text-align:center; line-height: 100px;">"Always remember your password."<h3>
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
<?php } ?>