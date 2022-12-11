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
  <style>



</style>
</head>

<body>

  <?php
  if(isset($_POST['submit']))
  {
    include_once('../../includes/conn.php');
    $name='';

    $errors=array();
    if(empty($_POST['name']))
    {
        $errors[] = 'select name';
    }
    else
    {
        $name = mysqli_real_escape_string($conn, trim($_POST['name']));
    }
    
    if(empty($errors))
    {
        $query = " INSERT INTO faculty (F_Name ) VALUES ('$name')";
        $r = mysqli_query($conn ,$query);
        
        
        if($r)
        {
            
          
            echo "<script>alert('Profile updated successfully');</script>";
           echo "<script type='text/javascript'> document.location = 'add-department.php' </script>";

            
            // header('location:../index.php');

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
              <form id="stripe-login" method="post">
                <div class="field padding-bottom--24">
                  <label for="name">Name The Exam</label>
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
  <?php } }?>
  
</body>


</html>