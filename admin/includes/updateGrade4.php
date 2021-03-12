<?php
    include('../../includes/config.php');
   
    if(isset($_POST['id'])){
        $value = $_POST['value'];
        $column = $_POST['column'];
        $id = $_POST['id'];

        $updateGrade = "UPDATE grades SET $column = '$value' WHERE StudentID = '$id' AND Quarter = 4 LIMIT 1;";
        $updateRes = mysqli_query($conn, $updateGrade);
        
        if($updateRes){
            $updateAVG = "SELECT AVG(English+Math+Science+Filipino+PE)/5 as rating FROM grades WHERE StudentID = '$id' AND Quarter = 4 LIMIT 1;";
            $AVG_result = mysqli_query($conn, $updateAVG);

            if($AVG_row = mysqli_fetch_assoc($AVG_result)){
                $rating = $AVG_row['rating'];
               
                $average = "UPDATE grades SET Average = '$rating' WHERE StudentID = '$id' AND Quarter = 4 LIMIT 1;";
                $final_result = mysqli_query($conn, $average);
                    
                    echo "Update Succefull";

            }else{
                    mysqli_error($conn);
            }
        }
        else{
            echo "Update Failed" . mysqli_error($conn);
        }
        mysqli_close($conn);
    }

?>