<?php
    include('../../includes/config.php');

    if(isset($_POST)){
        $value = $_POST['value'];
        $column = $_POST['column'];
        $id = $_POST['id'];

        $sqlUpdateTeacher = "UPDATE teachers SET $column = '$value' WHERE TeacherID = '$id' LIMIT 1;";
        $Teacher = mysqli_query($conn, $sqlUpdateTeacher);

       if($Teacher){
            echo "Teacher Update Successfull!";
       }else{
           echo "Teacher Update Failed";
       }
    }


?>