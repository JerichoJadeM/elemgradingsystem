<?php
    include("../includes/config.php");
    session_start();
    if(strlen($_SESSION['alogin'])==0){
        header('location: ../index.php');
    }
    else{
        $loginName = $_SESSION['alogin'];
        
        $User = "SELECT TeacherID FROM teachers WHERE Username = '$loginName';";
        $userQuery = mysqli_query($conn, $User);
        $teacherID = mysqli_fetch_assoc($userQuery);
        $teacher = $teacherID['TeacherID'];

        $sql = "SELECT * FROM students WHERE TeacherID = '$teacher';";
        $result = mysqli_query($conn, $sql);
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
    * {box-sizing: border-box;}
         .targetDiv {display: none;}
        #student {
        font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        }

    #student td, #customers th {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: center;
    width: 150px;
    }

    #student tr:nth-child(even){background-color: #f2f2f2;}

    /*#student tr:hover {background-color: #ddd;} */

    #student th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: center;
    background-color: #4CAF50;
    color: white;
    }
    #student th.th-studname{
        width: 300px;
        }
    #student td.StudName{
        text-align: left;
    }
    #student caption{
        padding: 15px;
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

    /* Clear floats (clearfix hack) */
    .btn-group:after {
    content: "";
    clear: both;
    display: table;
    }

    .btn-group button:not(:last-child) {
    border-right: none;
    }

    /* Add a background color on hover */
    .btn-group button:hover {
    background-color: deepblue;
    }
    /*End of Button Groups */

    /*Style para table update*/
        table{border-collapse: collapse;}
        td, th{width: 200px; height: 20px; outline: none; border: 1px solid #ccc;}
        div.td-update{outline: none;}
        th{background: #333; color: white}
        tr:nth-child(odd){background: #ddd;}
        .activate{
            background:white;
            border-top:1px solid #333;
            border-left:1px solid #333;
            border-right:1px solid #ccc;
            border-bottom:1px solid #ccc;
            padding: 2px;
        }
        .process{
            background: url('../assets/img/load.gif') no-repeat right;
            background-size: contain;
        }
        #del-record{
            height: 100%;
            background-color: maroon;
            padding: 1px;
        }
        #add-record{
            background-color: forestgreen;
        }
        /* ADD RECORD STYLING */
        .form-inline {  
            display: flex;
            flex-flow: column wrap;
            align-items: left;
            flex: 2;
        }

        .form-inline label {
        margin: 5px 10px 5px 0;
        }

        .form-inline input {
        vertical-align: left;
        margin: 5px 10px 5px 0;
        padding: 10px;
        background-color: #fff;
        border: 1px solid #ddd;
        }

        .form-inline button {
        padding: 10px 20px;
        background-color: dodgerblue;
        border: 1px solid #ddd;
        color: white;
        cursor: pointer;
        }

        .form-inline button:hover {
        background-color: royalblue;
        }
        .table-res{
        height:420px; width:100%;
        overflow-y: auto;
        border:2px solid #444;
        }.table-responsive:hover{border-color:red;}
        @media (max-width: 800px) {
            .form-inline input {
                margin: 10px 0;
            }
        
            .form-inline {
                flex-direction: column;
                align-items: stretch;
            }
        }
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
                <li><a href = "post-grades.php">Update Grades</a></li>
                <li><a class = "active" href = "my-profile.php">Manage Records</a></li>
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
                                <button type="button" onclick="window.location.href = 'my-profile.php';" class="cancelbtn">Cancel</button>
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
        <div><h2><strong>Record Management Section</strong></h2>
                    
        <div class = "btn-group">
            <button style = "width:33.333%;" class="showSingle" target="1">Edit/Delete Student Record</button>
            <button style = "width:33.3333%;" class="showSingle" target="2">Add New Student</button>
            <button style = "width:33.3333%;" class="showSingle" target="3">Your Profile</button>
        </div>

        <div id="div1" class="targetDiv1">
            <div class = "table-res">
            <table id = "student">
                <caption>*** <strong>Click</strong> each <strong>table cell</strong> to edit your <strong>student information</strong>. ***</caption>
                    <tr>
                        <th rowspan = 2>No.</th>
                        <th colspan = 3>Student Name</th>
                        <th rowspan = 2>LRN Number</th>
                        <th rowspan = 2>Grade Level</th>
                        <th rowspan = 2>Section</th>
                        <th rowspan = 2>Action</th>
                    </tr>  
                    <tr>
                        <th>Last Name</th>
                        <th>First Name</th>
                        <th>Middle Name</th>  
                    </tr>  
                        
            <?php
            
            $count = 1;
            while($row = mysqli_fetch_assoc($result)){
                $LRN = $row['LRN_Number'];
                $fname = $row['FirstName'];
                $Mname = $row['MidInitial'];
                $Lname = $row['LastName'];
                $grade = $row['GradeLevel'];
                $Section = $row['Section'];
                $id = $row['StudentID'];
            ?>

                <tr>
                    <td><?php echo $count?></td>
                    <td><div class = "td-update" contenteditable = "true" onBlur = "updateValue(this,'LastName', '<?php echo $id;?>')" onClick = "activate(this)"><?php echo $Lname;?></div></td>
                    <td><div class = "td-update" contenteditable = "true" onBlur = "updateValue(this,'FirstName', '<?php echo $id;?>')" onClick = "activate(this)"><?php echo $fname;?></div></td>
                    <td><div class = "td-update" contenteditable = "true" onBlur = "updateValue(this,'MidInitial', '<?php echo $id;?>')" onClick = "activate(this)"><?php echo $Mname;?></div></td>
                    <td><div class = "td-update" contenteditable = "true" onBlur = "updateValue(this,'LRN_Number', '<?php echo $id;?>')" onClick = "activate(this)"><?php echo $LRN;?></div></td>
                    <td><div class = "td-update" contenteditable = "true" onBlur = "updateValue(this,'GradeLevel', '<?php echo $id;?>')" onClick = "activate(this)"><?php echo $grade;?></div></td>
                    <td><div class = "td-update" contenteditable = "true" onBlur = "updateValue(this,'Section', '<?php echo $id;?>')" onClick = "activate(this)"><?php echo $Section;?></div></td>
                    <td><button id = "del-record" onClick = "deleteValue(this,'LRN_Number', '<?php echo $id;?>')">Delete</button></td>
                </tr>       
               
            <?php $count++; } mysqli_close($conn)?>
            </table>
            </div>
        </div>
<!--END ng UPDATE/DELETE TABLE-->

<!--START ng ADD FORM-->
        <div id="div2" class="targetDiv">
            <hr>
            <h3 style = "text-align: center">*** Add New Student Information  ***</h3><br>
                <div style ="float: left;">
                  <img src = "assets/img/kid.gif" width = "350px">
                </div>
      
            <div class = "add-record-container" style = "width: 500px; line-height: 30px; float: left;">
                <form class = "form-inline" action = "../includes/insert-record.php" method = "GET">
                    <strong>LRN_NUMBER:</strong><input type = "text" name = "LRN" placeholder = "Enter Student LRN Number" required>
                    <strong>  First Name:</strong><input type = "text" name = "fname" placeholder = "Enter Student First Name" required>
                    <strong> Middle Name:</strong><input type = "text" name = "mname" placeholder = "Enter Student Middle Name" required>
                    <strong> Last Name:</strong><input type = "text" name = "lname" placeholder = "Enter Student Last Name" required>
                    <button id = "add-record" type = "submit" name = "addrecord">Add</button>
                </form>     
            </div>
       
        </div>

<!--START NG YOUR PROFILE-->
        <div id="div3" class="targetDiv">
            <div style ="float: left; width: 650px">
            <table id = "student">
                <caption>*** <strong>Click</strong> each <strong>table cell</strong> to edit your <strong>information</strong>. ***</caption>
                <tr>
                    <th colspan = 4>Information</th>
                </tr>
        <?php
            include("../includes/config.php");
            $sqlTupdate = "SELECT * FROM teachers WHERE Username = '$loginName';";
            $TResult = mysqli_query($conn, $sqlTupdate);
            
            while($TRow = mysqli_fetch_assoc($TResult)){ 
                $id = $TRow['TeacherID'];
                $Tuser = $TRow['Username'];
                $TFname = $TRow['FirstName'];
                $TMname = $TRow['MidName'];
                $TLname = $TRow['LastName'];
                $Tgrade = $TRow['GradeLevel'];
                $TSection = $TRow['Section'];
                $Position = $TRow['Position'];
                $SName = $TRow['SchoolName'];
                $SAdd = $TRow['SchoolAddress'];
                $EAdd = $TRow['EmailAddress'];
                $dateJoined = $TRow['DateJoined'];
            
        ?>

                <tr>
                    <td style = "background-color:blue; color:white;">Full Name</td>
                    <td contenteditable = "true" onBlur = "updateTeacher(this,'FirstName', '<?php echo $id;?>')" onClick = "activate(this)"><?php echo $TFname;?></div></td>
                    <td contenteditable = "true" onBlur = "updateTeacher(this,'MidName', '<?php echo $id;?>')" onClick = "activate(this)"><?php echo $TMname;?></div></td>
                    <td contenteditable = "true" onBlur = "updateTeacher(this,'LastName', '<?php echo $id;?>')" onClick = "activate(this)"><?php echo $TLname;?></div></td>
                </tr>
        
                <tr><td style = "background-color:blue; color:white;">Username</td><td colspan = 3 contenteditable = "true" onBlur = "updateTeacher(this,'Username', '<?php echo $id;?>')" onClick = "activate(this)"><?php echo $Tuser;?></div></td></tr>
                <tr><td style = "background-color:blue; color:white;">Position</td><td colspan = 3 contenteditable = "true" onBlur = "updateTeacher(this,'Position', '<?php echo $id;?>')" onClick = "activate(this)" placeholder = "*Teacher I*"><?php echo $Position;?></div></td></tr>
                <tr><td style = "background-color:blue; color:white;">School Name</td><td colspan = 3 contenteditable = "true" onBlur = "updateTeacher(this,'SchoolName', '<?php echo $id;?>')" onClick = "activate(this)" placeholder = "Empty"><?php echo $SName;?></div></td></tr>
                <tr><td style = "background-color:blue; color:white;">School Address</td><td colspan = 3 contenteditable = "true" onBlur = "updateTeacher(this,'SchoolAddress', '<?php echo $id;?>')" onClick = "activate(this)" placeholder = "Empty"><?php echo $SAdd;?></div></td></tr>
        
                <tr>
                    <td style = "background-color:blue; color:white;">Grade Assigned</td>
                    <td contenteditable = "true" onBlur = "updateTeacher(this,'GradeLevel', '<?php echo $id;?>')" onClick = "activate(this)"><?php echo $Tgrade;?></div></td>
                    <td style = "background-color:blue; color:white;">Section</td>
                    <td contenteditable = "true" onBlur = "updateTeacher(this,'Section', '<?php echo $id;?>')" onClick = "activate(this)"><?php echo $TSection;?></div></td>
                </tr>
        
                <tr><td style = "background-color:blue; color:white;">Email Address</td><td colspan = 3 contenteditable = "true" onBlur = "updateTeacher(this,'EmailAddress', '<?php echo $id;?>')" onClick = "activate(this)" placeholder = "Empty"><?php echo $EAdd;?></div></td></tr>
                <tr><td style = "background-color:blue; color:white;">Date Joined:</td><td colspan = 3 ><?php echo $dateJoined;?></td></tr>
        <?php } ?>
            </table>
        </div>
            <div style ="float: left;">
                <img src = "assets/img/teacher.gif" width = "350px">
            </div>
        </div>
    </div>
    </div>
    </main>
    </div>
    
<script>
// Update functions ng data table nasa loob [TD > DIV contenteditable]

    function activate(element){
        $(element).attr('class', 'activate')
    }

    function updateValue(element, column, id){
       var value = element.innerText;
       $(element).attr('class', 'process')
        $.ajax({
            url: '../includes/update.php',
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
   function updateTeacher(element, column, id){
       var value = element.innerText;
       $(element).attr('class', 'process')
        $.ajax({
            url: 'includes/updateTeacher.php',
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
   // Function sang delete button sa table once ma click
   function deleteValue(element, column, id){

    var sureness = confirm("Are you sure want to delete record of selected student? Press Okay to confirm.");
    if(sureness == true){
    var value = element.innerText;
    $.ajax({
     url: '../includes/delete.php',
     type: 'post',
     data:{
         value: value,
         column: column,
         id: id
     },
     success:function(php_result){
         console.log(php_result);
     }
    })

    alert("Record Deleted!");
    document.location = "../admin/my-profile.php";
    }
    else{
        alert("Action Canceled!");
    }
    }
</script>

<script>
//Para sa button group click and hide then lalabas ang data table.

    jQuery(function(){
        jQuery('.showSingle').click(function(){
              jQuery('.targetDiv').slideUp();
              jQuery('.targetDiv1').hide();
              jQuery('.targetDiv').hide();
              jQuery('#div'+$(this).attr('target')).slideToggle();
        });
    });
// END ng script ng button group feature
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