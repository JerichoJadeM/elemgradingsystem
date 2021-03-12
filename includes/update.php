<?php
include('config.php');
sleep(1);
if(isset($_POST['id'])){
    $value = $_POST['value'];
    $column = $_POST['column'];
    $id = $_POST['id'];

    $sql = "UPDATE students SET $column = '$value' WHERE StudentID = '$id' LIMIT 1;";
    $result = mysqli_query($conn, $sql);

    if($result){
        echo "Update Successfull";
    }
    else{
        echo "Update Failed: " . mysqli_error($conn);
    }
    mysqli_close($conn);
}
