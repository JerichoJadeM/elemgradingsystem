<?php
include('config.php');
sleep(1);
if(isset($_POST['id'])){
    $value = $_POST['value'];
  echo  $column = $_POST['column'];
    $id = $_POST['id'];

    $sql = "DELETE FROM students WHERE StudentID = '$id' LIMIT 1;";
    $result = mysqli_query($conn, $sql);

    if($result){
        echo "Delete Successfull;
        <script type = 'text/javascript'> document.location = '../admin/my-profile.php'; </script>";
    }
    else{
        echo "Delete Failed: " . mysqli_error($conn);
    }
    mysqli_close($conn);
}
