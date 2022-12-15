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
  <script><?php include_once("../js/ajax.js")?></script>

</head>

<body>

  <?php
  
  if(isset($_POST['submit']))
  {
    include_once('../../includes/conn.php');
    $type='';
    $time='';
    $subject='';
    $errors=array();
    
    if(empty($_POST['type']))
    {
        $errors[] = 'select type';
    }
    else
    {
        $type = mysqli_real_escape_string($conn, trim($_POST['type']));
    }
    
    if(empty($_POST['time']))
    {
        $errors[] = 'select time'; 
    }
    else
    {
        $time = mysqli_real_escape_string($conn, trim($_POST['time']));
    }
    if(empty($_POST['subject']))
    {
        $errors[] = 'select subject'; 
    }
    else
    {
        $subject = mysqli_real_escape_string($conn, trim($_POST['subject']));
    }
    
    if(empty($errors))
    {
        $query = "INSERT INTO exam (Ex_Type, Ex_Duration, Ex_Date, Su_ID) VALUES ('$type','$time',NOW(),'$subject')";
        $r = @mysqli_query($conn ,$query);
  
        if($r)
        {
          echo "<script>alert('Profile updated successfully');</script>";
          echo "<script type='text/javascript'> document.location = '../manage-exam.php' </script>";

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
    <div class="box-background--white box-root flex-flex flex-direction--column" style="min-height: 100vh;flex-grow: 1;">

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
                  
                  <select  class="form-control" name="faculty" id="fact" onchange="getData('dep')" required>
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
                  <select  class="form-control" name="department" id="department" onchange="getData('pro')" required>
                   

                  </select>
                </div>
                <div class="field padding-bottom--24">
                  <label for="program">Program</label>
                  <select  class="form-control" name="program" id="program" onchange="getData('sub')" required>
                   

                  </select>
                </div>
                <div class="field padding-bottom--24">
                <label>Semster</label>
                <select  class="form-control" name="semster" id="semster" onchange="getData('sem')" required >
                <option value="0">select semster :</option>
                <option value="1">one</option>
                <option value="2">two</option>
                <option value="3">three</option>
                <option value="4">four</option>
                <option value="5">five</option>
                <option value="6">six</option>
                <option value="7">seven</option>
                   </select>
                  
            </div>
                <div class="field padding-bottom--24">
                  <label for="subject">Subject</label>
                  <select  class="form-control" name="subject" id="subject" >
                   
                  </select>
                </div>
                <div class="field padding-bottom--24 ">
            <label>Exam Type</label>
            <select class="form-control" name="type" required>

              <option value="">Select Type</option>
              <option value="Sem Fainal">Sem Fainal</option>
              <option value="Test">Test</option>
              <option value="Fainal">Fainal</option> 

            </select>
          </div>
                <div class="field padding-bottom--24 form-group">
            <label>Exam Time Limit</label>
            <select class="form-control" name="time" required>
              <option value="0">Select time</option>
              <option value="10">10 Minutes</option> 
              <option value="20">20 Minutes</option> 
              <option value="30">30 Minutes</option> 
              <option value="40">40 Minutes</option> 
              <option value="50">50 Minutes</option> 
              <option value="60">60 Minutes</option> 
            </select>
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