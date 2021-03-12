<?php
    include('config.php');
    session_start();
    
    $loginName = $_SESSION['alogin'];

    $user = "SELECT * FROM teachers WHERE Username = '$loginName';";
    $User_query = mysqli_query($conn, $user);
    $UserRow = mysqli_fetch_assoc($User_query);

    $Tid = $UserRow['TeacherID'];
    $gUser = $UserRow['GradeLevel'];
    $gSection = $UserRow['Section'];

    if(isset($_GET['addrecord'])){
        $LRN = $_GET['LRN'];
        $fname = $_GET['fname'];
        $mname = $_GET['mname'];
        $lname = $_GET['lname'];

        $sqlAdd = "INSERT INTO students
        (LRN_Number, FirstName, MidInitial, LastName, GradeLevel, Section, TeacherID)
        VALUES
        ('$LRN', '$fname', '$mname', '$lname', '$gUser', '$gSection', $Tid);";
        $AddResult = mysqli_query($conn, $sqlAdd);
        $lastID = mysqli_insert_id($conn);

        $newStud = $lastID;

        if($AddResult){

            $qrt_count = 1;
            
            for($i=1;$i<=4;$i++){
                
                $temp_grade = "INSERT INTO grades 
                (TeacherID, StudentID, Quarter, English, Math, Science, Filipino, PE, Average)
                VALUES
                ('$Tid', '$newStud',$qrt_count, 0, 0, 0 ,0 , 0,0 );";
                 $Temp = mysqli_query($conn, $temp_grade);

                 $qrt_count+=1;
            }
            echo "<script>alert('New Student Record Added!');
            document.location = '../admin/my-profile.php'</script>";
         
        }else{
            echo "Saving New Record Unsucessfull" . mysqli_error($conn);
        }
        mysqli_close($conn);
    }
?>