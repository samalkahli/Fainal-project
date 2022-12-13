<?php 
session_start();
include_once('../../includes/conn.php');
$id=$_SESSION['id'];
$query=mysqli_query($conn,"SELECT * FROM admin WHERE Ad_ID=".$id);
$result= mysqli_fetch_array($query);
if (strlen($_SESSION['id']==0))
  {
    header('location:../../outSession.php');
  }
  else{ ?>
<html>
<head>
  <meta charset="utf-8">
  <title>Sign in</title>  
  <link rel="stylesheet" type="text/css" href="..\..\css\styleLogin.css">
  <script src="../js/jquery.js"></script>
<script>
    function getData(data)
    {
      //alert('ok');
      if(data == 'dep')
      {
        //console.log( $('fact') );
        var fact = document.getElementById('fact').value;
        // alert(fact);
        $("#department").empty();
        if(fact>0)
        {
          $.get("getDepartment.php?data=dep&fact="+fact, function(data, status)
          {
            //alert("Data: " + fact + "\nStatus: " + status); 
              $("#department").empty(); 
              $('#department').append(data);
          });
        }
        
        else 
        return false;
        
          
      }
      if(data == 'pro')
      {
        //console.log( $('fact') );
        var department = document.getElementById('department').value;
        //alert(department);
        $("#program").empty();
        if(department>0)
        {
          $.get("getProgram.php?data=pro&department="+department, function(data, status)
          {
            //alert("Data: " + fact + "\nStatus: " + status); 
              $("#program").empty(); 
              $('#program').append(data);
          });
        }
        else 
        return false;
      }
      if(data == 'sub')
      {
        //console.log( $('fact') );
        var program = document.getElementById('program').value;
        //alert(program);
        $("#subject").empty();
        if(program>0)
        {
          $.get("getSubject.php?data=sub&program="+program, function(data, status)
          {
            //alert("Data: " + fact + "\nStatus: " + status); 
              $("#subject").empty(); 
              $('#subject').append(data);
          });
        }
        else 
        return false;
      }

    }
    </script>
</head>

<body>

  <?php
  if(isset($_POST['submit']))
  {
    include_once('../../includes/conn.php');
    $name='';
    $semster='';
    $lecturer='';
    $program='';
    $errors=array();
    
    if(empty($_POST['name']))
    {
        $errors[] = 'select name';
    }
    else
    {
        $name = mysqli_real_escape_string($conn, trim($_POST['name']));
    }
    
    if(empty($_POST['semster']))
    {
        $errors[] = 'select semster'; 
    }
    else
    {
        $semster = mysqli_real_escape_string($conn, trim($_POST['semster']));
    }
    if(empty($_POST['lecturer']))
    {
        $errors[] = 'select lecturer';
    }
    else
    {
        $lecturer = mysqli_real_escape_string($conn, trim($_POST['lecturer']));
    }
    
    if(empty($_POST['program']))
    {
        $errors[] = 'select program';
    }
    else
    {
        $program = mysqli_real_escape_string($conn, trim($_POST['program']));
    }
    
    if(empty($errors))
    {
        $query = "INSERT INTO exam (Ex_Type, semster, Le_ID, P_ID) VALUES ('$name','$semster','$lecturer','$program')";
        $r = @mysqli_query($conn ,$query);
  
        if($r)
        {
          echo "<script>alert('Profile updated successfully');</script>";
          echo "<script type='text/javascript'> document.location = '../manage-subject.php' </script>";

        }
        
    }   
    else
    {
      echo '<h1> Error!</h1>
      <p calss="error">The following error(s) occurred:<br/>';
      foreach ($errors as $msg)
      {
        echo " - $msg<br />\n";
      }
      echo '</p><p>Plasse try again.</p><p><br /></p>';  
    }

    mysqli_close($conn);
    }
    
  else
  {
    /*function printForm($first_name="", $last_name="" ,$lecturer="")
     {*/
  ?>
  <form action="" method="post">
  <div class="login-root">
    <div class="box-root flex-flex flex-direction--column" style="min-height: 100vh;flex-grow: 1;">
      <div class="loginbackground box-background--white padding-top--64">
        
      </div>
      <div class="box-root padding-top--24 flex-flex flex-direction--column" style="flex-grow: 1; z-index: 9;">
       <div class="formbg-outer">
       <div class="box-root padding-top--48 padding-bottom--24 flex-flex flex-justifyContent--center">
          <a href="../index.php"><img src="../../images/Logo.png"></a>
        </div>
 
          <div class="formbg">
            <div class="formbg-inner padding-horizontal--48">
              <span class="padding-bottom--15">Add Exam</span>
              <form id="stripe-login">
              <div class="field padding-bottom--24">
                  <label>Faculty</label>
                  
                  <select  class="form-control" name="faculty" id="fact" onchange="getData('dep')">
                    <option value="0">Select faculty:</option>
                    
                    <?php 
              include_once('../../includes/conn.php');
                $selCourse = mysqli_query($conn,"SELECT * FROM faculty ORDER BY F_ID asc");
                while ($selCourseRow = mysqli_fetch_assoc($selCourse)){ ?>
                  <option value="<?php echo $selCourseRow['F_ID']; ?>"><?php echo $selCourseRow['F_Name']; ?></option>
                <?php }
               ?>
            </select>
                </div>
                <div class="field padding-bottom--24">
                  <label for="department">Department</label>
                  <select  class="form-control" name="department" id="department" onchange="getData('pro')">
                   

                  </select>
                </div>
                <div class="field padding-bottom--24">
                  <label for="program">Program</label>
                  <select  class="form-control" name="program" id="program" onchange="getData('sub')" >
                   

                  </select>
                </div>
                <div class="field padding-bottom--24">
                  <label for="subject">Subject</label>
                  <select  class="form-control" name="subject" id="subject" >
                   

                  </select>
                </div>
             
                <div class=" padding-bottom--24">
                <label>Semster</label>
                 <input type="radio" id="html" name="fav_language" value="HTML"> HTML
                  <input type="radio" id="css" name="fav_language" value="CSS">CSS

                  <input type="radio" id="javascript" name="fav_language" value="JavaScript">JS
                  
                  
            </div>
            
            <div class="field padding-bottom--24">
            <label>Lecturer</label>
            <select class="form-control" name="lecturer">
            <option value="0">Select Lecturer</option>
              <?php 
              include_once('../../includes/conn.php');
                $selCourse = mysqli_query($conn,"SELECT * FROM lecturer ORDER BY Le_ID asc");
                while ($selCourseRow = mysqli_fetch_assoc($selCourse)){ ?>
                  <option value="<?php echo $selCourseRow['Le_ID']; ?>"><?php echo $selCourseRow['Le_Name']; ?></option>
                <?php }
               ?>
            </select>
                </div>
                <div class="field padding-bottom--24">
                  <label for="name">Name The Subject</label>
                  <input type="text" name="name">
                </div>
               
                <div class="field padding-bottom--19">
                <div class="formbg-inner">

                  <input type="submit" name="submit" value="Continue">
                </div>
              </div>
              </form>
            </div>
          </div>
         
        </div>
      </div>
    </div>
  </div>
    </form>
  <?php }} ?>
  
</body>


</html>