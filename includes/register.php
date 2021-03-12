<?php
    include('config.php');

    

    if(isset($_POST['signup'])){
        $Fname = $_POST['firstname'];
        $Mname = $_POST['midname'];
        $Lname = $_POST['lastname'];
        $Glevel = $_POST['gradelevel'];
        $Section = $_POST['section'];
        $UserName = $_POST['username'];
        $Password = $_POST['psw'];
        $rePass = $_POST['repsw'];

        if($Password != $rePass){
            echo "<script>alert('Password did not match!')
                document.location = '../index.php';</script>";
        }
        if($Password == $rePass){
            $sql = "INSERT INTO teachers
            (FirstName, MidName, LastName, GradeLevel, Section, Username, Password, DateJoined) VALUES
            ('$Fname', '$Mname', '$Lname', '$Glevel', '$Section', '$UserName', '$Password', CURRENT_DATE());";
            $result = mysqli_query($conn, $sql);

            if($result){
                echo "<script>alert('Registered Successfully! You can now login!')
                document.location = '../index.php';</script>";
            }
            else{
                echo "<script>alert('Please Try Again!') document.location = '../index.php';</script>";
            }
        }
        mysqli_close($conn);
    }
  ?>