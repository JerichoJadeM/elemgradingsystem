<?php
    include('config.php');
?>
<!DOCTYPE html>
<html lang = "en">
<head>
    <meta charset = "utf-8">
    <meta name = "viewport" content = "width=device-width, initial-scale = 1.0">
    <title>Grading System Viewer</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel = "stylesheet" href = "../assets/css/style.form.css">
    
    <style>
        body{
            background-color:transparent;
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
    <div class="container">
        <div class="row mx-auto mt-5 mb-1">
                <div class="col-sm-8">
                    <form class="validate" method="GET">
                    <input class="form-control" name="num" placeholder="Enter your LRN" />
                </div>
                <div class="col-sm-4">
                    <button class="btn btn-primary mt-0" type="submit" name="Search">Search</button>
                    </form>
                </div>
        </div>
        <div class="row">
            <div class = "mt-0">
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

                <table id = "table-responsive student-card mb-0">
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
<script src="../assets/js/bootstrap.min.js"></script>
</body>
</html>