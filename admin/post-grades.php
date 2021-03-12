<?php
    include("../includes/config.php");
    session_start();
    if(strlen($_SESSION['alogin'])==0){
        header('location: ../index.php');
    }
    else{
          $loginName = $_SESSION['alogin'];

          $sqlDis = "SELECT students.LastName, students.FirstName, students.MidInitial, teachers.Username, students.StudentID, Quarter, English, Math, Science, Filipino, PE 
                    FROM grades INNER JOIN students ON grades.StudentID = students.StudentID 
                    INNER JOIN teachers ON grades.TeacherID = teachers.TeacherID 
                    WHERE teachers.Username = '$loginName' AND Quarter = 1;";
                    $DisResult = mysqli_query($conn, $sqlDis);
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

    <script src = "libraries/jquery-3.5.1.min.js"></script>
    <style>
        .targetDiv {display: none;}
        #customers {
        font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        overflow-x: auto;
        }

        #customers td, #customers th {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: center;
        width: 150px;
        }

        #customers tr:nth-child(even){background-color: #f2f2f2;}

        #customers tr:hover {background-color: #ddd;}

        #customers th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: center;
        background-color: #4CAF50;
        color: white;
        }
        #customers th.th-studname{
            width: 300px;
            }
        #customers td.StudName{
            text-align: left;
        }
        #customers caption{
            padding: 10px;
            text-align: left;
            width: 100%;
        }
        /*Button Groups */
        .btn-group button {
        background-color: dodgerblue;
        border: 1px solid green;
        color: white;
        padding: 10px 24px;
        cursor: pointer;
        float: left; 
        }

        .btn-group:after {
        content: "";
        clear: both;
        display: table;
        }

        .btn-group button:not(:last-child) {
        border-right: none;
        }

        .btn-group button:hover {
        background-color: deepblue;
        }
        /*End of Button Groups */
        .table-res{
        height:420px; width:100%;
        overflow-y: auto;
        border:2px solid #444;
        }.table-responsive:hover{border-color:red;}
    </style>
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
                <li><a class = "active" href = "post-grades.php">Update Grades</a></li>
                <li><a href = "my-profile.php">Manage Records</a></li>
                <li><span>Other</span></li>
                <li><a href = "https://web.facebook.com/aegon.madolid/" target = "_blank">Follow Developer</a></li>
                <li><a href = "change-password.php">Change Password</a></li>
                <li><a href = "#openModal">Log Out</a>
                    <div id="openModal" class="modalDialog">
                        <div>
                            <h2>ATTENTION!</h2>
                            <p>You are about to log out. If you wish to remain logged in, click the cancel button. If not click proceed button.</p>
                            <form action = "logout.php" method = "POST">
                            <div class="clearfix">
                                <button type="button" onclick="window.location.href = 'post-grades.php';" class="cancelbtn">Cancel</button>
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
        <div><h2>Click each button to <strong>view and edit</strong> grades per Quarter</h2>
               
        <div class = "btn-group">
            <button style = "width:25%;" class="showSingle" target="1">First Quarter</button>
            <button style = "width:25%;" class="showSingle" target="2">Second Quarter</button>
            <button style = "width:25%;" class="showSingle" target="3">Third Quarter</button>
            <button style = "width:25%;" class="showSingle" target="4">Fourth Quarter</button>
        </div>

<!--Start ng Update ng Student grades-->
        <div id="div1" class="targetDiv1">
            <div class = "table-res">
            <table id = "customers">
                <caption>*** Click table cells of <strong>Subjects</strong> to input Grades for <strong>First Grading Period</strong>. ***</caption>
                    <tr>
                        <th rowspan = 2 class = "th-studname">Student Name</th>
                        <th colspan = 5>Subject</th>
                        <th rowspan = 2>Average</th>
                    </tr> 

                    <tr>
                        <th>English</th>
                        <th>Mathematics</th>
                        <th>Science</th>
                        <th>Filipino</th>
                        <th>P.E</th>
                    </tr>  
                        
                <?php

                    while($DisRow = mysqli_fetch_assoc($DisResult)){
                        $Fname = $DisRow['FirstName'];
                        $Mname = $DisRow['MidInitial'];
                        $Lname = $DisRow['LastName'];
                        $english = $DisRow['English'];
                        $math = $DisRow['Math'];
                        $sci = $DisRow['Science'];
                        $fil = $DisRow['Filipino'];
                        $pe = $DisRow['PE'];
                        $qtr = $DisRow['Quarter'];
                        $id = $DisRow['StudentID'];
                            
                        $rating_ave = ($english+$math+$sci+$fil+$pe)/5;
                ?>
                        
                    <tr>
                        <td class = "StudName" contenteditable="false"><?php echo $Lname. ", " . $Fname . " " . $Mname;?></td>
                        <td><div contenteditable = "true" onBlur = "updateGrade(this,'English', '<?php echo $id;?>')" onClick = "activate(this)"><?php echo $english;?></div></td>
                        <td><div contenteditable = "true" onBlur = "updateGrade(this,'Math', '<?php echo $id;?>')" onClick = "activate(this)"><?php echo $math;?></div></td>
                        <td><div contenteditable = "true" onBlur = "updateGrade(this,'Science', '<?php echo $id;?>')" onClick = "activate(this)"><?php echo $sci;?></div></td>
                        <td><div contenteditable = "true" onBlur = "updateGrade(this,'Filipino', '<?php echo $id;?>')" onClick = "activate(this)"><?php echo $fil;?></div></td>
                        <td><div contenteditable = "true" onBlur = "updateGrade(this,'PE', '<?php echo $id;?>')" onClick = "activate(this)"><?php echo $pe;?></div></td>
                        <td><div id = "auto"><?php echo $rating_ave?></td>
                    </tr> 
                       
                <?php  } mysqli_close($conn);?>
            </table>
            </div>
    </div>

        <div id="div2" class="targetDiv">
            <div class = "table-res">
            <table id = "customers">
                <caption>*** Click table cells of <strong>Subjects</strong> to input Grades for <strong>Second Grading Period</strong>. ***</caption>
                    <tr>
                        <th rowspan = 2 class = "th-studname">Student Name</th>
                        <th colspan = 5>Subject</th>
                        <th rowspan = 2>Average</th>
                    </tr>  
                        
                    <tr>
                        <th>English</th>
                        <th>Mathematics</th>
                        <th>Science</th>
                        <th>Filipino</th>
                        <th>P.E</th>
                    </tr> 
                        
                <?php

                    include("../includes/config.php");

                    $qrt = "SELECT students.LastName, students.FirstName, students.MidInitial, teachers.Username, students.StudentID, Quarter, English, Math, Science, Filipino, PE 
                        FROM grades INNER JOIN students ON grades.StudentID = students.StudentID 
                        INNER JOIN teachers ON grades.TeacherID = teachers.TeacherID 
                        WHERE teachers.Username = '$loginName' AND Quarter = 2;";
                    $qrtResult = mysqli_query($conn, $qrt);
                        
                       while($qrtRow = mysqli_fetch_assoc($qrtResult)){
                            $Fname2 = $qrtRow['FirstName'];
                            $Mname2 = $qrtRow['MidInitial'];
                            $Lname2 = $qrtRow['LastName'];
                            $english2 = $qrtRow['English'];
                            $math2 = $qrtRow['Math'];
                            $sci2 = $qrtRow['Science'];
                            $fil2 = $qrtRow['Filipino'];
                            $pe2 = $qrtRow['PE'];
                            $qtr2 = $qrtRow['Quarter'];
                            $id = $qrtRow['StudentID'];
                            
                            $rating_ave2 = ($english2+$math2+$sci2+$fil2+$pe2)/5;
                ?> 
                        
                    <tr>
                        <td class = "StudName" contenteditable="false"><?php echo $Lname2 . ", " . $Fname2 . " " . $Mname2;?></td>
                        <td><div contenteditable = "true" onBlur = "updateGrade2(this,'English', '<?php echo $id;?>')" onClick = "activate(this)"><?php echo $english2;?></div></td>
                        <td><div contenteditable = "true" onBlur = "updateGrade2(this,'Math', '<?php echo $id;?>')" onClick = "activate(this)"><?php echo $math2;?></div></td>
                        <td><div contenteditable = "true" onBlur = "updateGrade2(this,'Science', '<?php echo $id;?>')" onClick = "activate(this)"><?php echo $sci2?></div></td>
                        <td><div contenteditable = "true" onBlur = "updateGrade2(this,'Filipino', '<?php echo $id;?>')" onClick = "activate(this)"><?php echo $fil2;?></div></td>
                        <td><div contenteditable = "true" onBlur = "updateGrade2(this,'PE', '<?php echo $id;?>')" onClick = "activate(this)"><?php echo $pe2;?></div></td>
                        <td><?php echo $rating_ave2?></td>
                    </tr>  

                <?php  } mysqli_close($conn);?>     
            </table>
            </div>
        </div>

        <div id="div3" class="targetDiv">
            <div class = "table-res">
            <table id = "customers">
                <caption>*** Click table cells of <strong>Subjects</strong> to input Grades for <strong>Third Grading Period</strong>. ***</caption>
                    <tr>
                        <th rowspan = 2 class = "th-studname">Student Name</th>
                        <th colspan = 5>Subject</th>
                        <th rowspan = 2>Average</th>
                    </tr> 

                    <tr>
                        <th>English</th>
                        <th>Mathematics</th>
                        <th>Science</th>
                        <th>Filipino</th>
                        <th>P.E</th>
                    </tr> 

                <?php

                    include("../includes/config.php");

                        $qrt3 = "SELECT students.LastName, students.FirstName, students.MidInitial, teachers.Username, students.StudentID, Quarter, English, Math, Science, Filipino, PE 
                        FROM grades INNER JOIN students ON grades.StudentID = students.StudentID 
                        INNER JOIN teachers ON grades.TeacherID = teachers.TeacherID 
                        WHERE teachers.Username = '$loginName' AND Quarter = 3;";
                        $qrtResult3 = mysqli_query($conn, $qrt3);
                        
                        while($qrtRow3 = mysqli_fetch_assoc($qrtResult3)){
                            $Fname3 = $qrtRow3['FirstName'];
                            $Mname3 = $qrtRow3['MidInitial'];
                            $Lname3 = $qrtRow3['LastName'];
                            $english3 = $qrtRow3['English'];
                            $math3 = $qrtRow3['Math'];
                            $sci3 = $qrtRow3['Science'];
                            $fil3 = $qrtRow3['Filipino'];
                            $pe3 = $qrtRow3['PE'];
                            $qtr3 = $qrtRow3['Quarter'];
                            $id = $qrtRow3['StudentID'];
                            
                            $rating_ave3 = ($english3+$math3+$sci3+$fil3+$pe3)/5;
                ?> 
                    
                    <tr>
                        <td class = "StudName" contenteditable="false"><?php echo $Lname3 . ", " . $Fname3 . " " . $Mname3;?></td>
                        <td><div contenteditable = "true" onBlur = "updateGrade3(this,'English', '<?php echo $id;?>')" onClick = "activate(this)"><?php echo $english3;?></div></td>
                        <td><div contenteditable = "true" onBlur = "updateGrade3(this,'Math', '<?php echo $id;?>')" onClick = "activate(this)"><?php echo $math3;?></div></td>
                        <td><div contenteditable = "true" onBlur = "updateGrade3(this,'Science', '<?php echo $id;?>')" onClick = "activate(this)"><?php echo $sci3?></div></td>
                        <td><div contenteditable = "true" onBlur = "updateGrade3(this,'Filipino', '<?php echo $id;?>')" onClick = "activate(this)"><?php echo $fil3;?></div></td>
                        <td><div contenteditable = "true" onBlur = "updateGrade3(this,'PE', '<?php echo $id;?>')" onClick = "activate(this)"><?php echo $pe3;?></div></td>
                        <td><?php echo $rating_ave3?></td>
                    </tr>   
                        
                <?php  } mysqli_close($conn);?>           
            </table>
            </div>
        </div>
  
        <div id="div4" class="targetDiv">
            <div class = "table-res">
            <table id = "customers">
                <caption>*** Click table cells of <strong>Subjects</strong> to input Grades for <strong>Fourth Grading Period</strong>. ***</caption>
                    <tr>
                        <th rowspan = 2 class = "th-studname">Student Name</th>
                        <th colspan = 5>Subject</th>
                        <th rowspan = 2>Average</th>
                    </tr>

                    <tr>
                        <th>English</th>
                        <th>Mathematics</th>
                        <th>Science</th>
                        <th>Filipino</th>
                        <th>P.E</th>
                    </tr> 

                <?php

                    include("../includes/config.php");

                        $qrt4 = "SELECT students.LastName, students.FirstName, students.MidInitial, teachers.Username, students.StudentID, Quarter, English, Math, Science, Filipino, PE 
                        FROM grades INNER JOIN students ON grades.StudentID = students.StudentID 
                        INNER JOIN teachers ON grades.TeacherID = teachers.TeacherID 
                        WHERE teachers.Username = '$loginName' AND Quarter = 4;";
                        $qrtResult4 = mysqli_query($conn, $qrt4);
                        
                        while($qrtRow4 = mysqli_fetch_assoc($qrtResult4)){
                            $Fname4 = $qrtRow4['FirstName'];
                            $Mname4 = $qrtRow4['MidInitial'];
                            $Lname4 = $qrtRow4['LastName'];
                            $english4 = $qrtRow4['English'];
                            $math4 = $qrtRow4['Math'];
                            $sci4 = $qrtRow4['Science'];
                            $fil4 = $qrtRow4['Filipino'];
                            $pe4 = $qrtRow4['PE'];
                            $qtr4 = $qrtRow4['Quarter'];
                            $id = $qrtRow4['StudentID'];
                            
                            $rating_ave4 = ($english4+$math4+$sci4+$fil4+$pe4)/5;
                ?> 
                    
                    <tr>
                        <td class = "StudName" contenteditable="false"><?php echo $Lname4 . ", " . $Fname4 . " " . $Mname4;?></td>
                        <td><div contenteditable = "true" onBlur = "updateGrade4(this,'English', '<?php echo $id;?>')" onClick = "activate(this)"><?php echo $english4;?></div></td>
                        <td><div contenteditable = "true" onBlur = "updateGrade4(this,'Math', '<?php echo $id;?>')" onClick = "activate(this)"><?php echo $math4;?></div></td>
                        <td><div contenteditable = "true" onBlur = "updateGrade4(this,'Science', '<?php echo $id;?>')" onClick = "activate(this)"><?php echo $sci4?></div></td>
                        <td><div contenteditable = "true" onBlur = "updateGrade4(this,'Filipino', '<?php echo $id;?>')" onClick = "activate(this)"><?php echo $fil4;?></div></td>
                        <td><div contenteditable = "true" onBlur = "updateGrade4(this,'PE', '<?php echo $id;?>')" onClick = "activate(this)"><?php echo $pe4;?></div></td>
                        <td><?php echo $rating_ave4?></td>
                    </tr>   
                
                <?php  } mysqli_close($conn);?>   
            </table>
            </div>
        </div>
        </div>
        </div>
    </main>
    </div>
<script>
  // Update functions ng data table nasa loob [TD > DIV contenteditable] GRADES

    function activate(element){
        $(element).attr('class', 'activate')
    }

    function updateGrade(element, column, id){
       var value = element.innerText;
       $(element).attr('class', 'process')
        $.ajax({
            url: 'includes/updateGrade.php',
            type: 'post',
            data:{
                value: value,
                column: column,
                id: id
            },
            success:function(php_result){
                console.log(php_result);
                $(element).removeAttr('class');
            }
        })
   }

   function updateGrade2(element, column, id){
       var value = element.innerText;
       $(element).attr('class', 'process')
        $.ajax({
            url: 'includes/updateGrade2.php',
            type: 'post',
            data:{
                value: value,
                column: column,
                id: id
            },
            success:function(php_result){
                console.log(php_result);
                $(element).removeAttr('class');
            }
        })
   }

   function updateGrade3(element, column, id){
       var value = element.innerText;
       $(element).attr('class', 'process')
        $.ajax({
            url: 'includes/updateGrade3.php',
            type: 'post',
            data:{
                value: value,
                column: column,
                id: id
            },
            success:function(php_result){
                console.log(php_result);
                $(element).removeAttr('class');
            }
        })
   }

   function updateGrade4(element, column, id){
       var value = element.innerText;
       $(element).attr('class', 'process')
        $.ajax({
            url: 'includes/updateGrade4.php',
            type: 'post',
            data:{
                value: value,
                column: column,
                id: id
            },
            success:function(php_result){
                console.log(php_result);
                $(element).removeAttr('class');
            }
        })
   }
</script>

<script>
// Para to sa toggle buttons
  jQuery(function(){
        jQuery('.showSingle').click(function(){
              jQuery('.targetDiv').slideUp();
              jQuery('.targetDiv1').hide();
              jQuery('.targetDiv').hide();
              jQuery('#div'+$(this).attr('target')).slideToggle();
        });
});
  </script>

<script>
        var modal = document.getElementById('openModal');
            window.onclick = function(event) {
                if (event.target == modal) {
                modal.style.display = "none";
                document.location = "index.php";
            }
        }
</script>

<script>
    
    var $el = $(".table-res");
    function anim() {
    var st = $el.scrollTop();
    var sb = $el.prop("scrollHeight")-$el.innerHeight();
    $el.animate({scrollTop: st<sb/2 ? sb : 0}, 50000, anim);
    }
    function stop(){
    $el.stop();
    }
    anim();
    $el.hover(stop, anim);
</script>
</body>
</html>
<?php } ?>