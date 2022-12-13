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
  .redio 
  {
    height: 12px;
    margin-left: 30px;
  }
</style>
</head>


<body>
<div class="app-main__outer">
    <div id="refreshData">
    <div class="app-main__inner">
  <?php

  if(isset($_POST['submit']))
  {
    include_once('../../includes/conn.php');
    $name='';
    $birthday='';
    $email='';
    $gender='';
    $degree='';
    $password='';
    $errors=array();
    if(empty($_POST['name']))
    {
        $errors[] = 'select name';
    }
    else
    {
        $name = mysqli_real_escape_string($conn, trim($_POST['name']));
    }
    if(empty($_POST['birthday']))
    {
        $errors[] = 'select birthday'; 
    }
    else
    {
        $birthday = mysqli_real_escape_string($conn, trim($_POST['birthday']));
    }
    if(empty($_POST['email']))
    {
        $errors[] = 'select email';
    }
    else
    {
        $email = mysqli_real_escape_string($conn, trim($_POST['email']));
    }
    if(empty($_POST['gender']))
    {
        $errors[] = 'select gender'; 
    }
    else
    {
        $gender = mysqli_real_escape_string($conn, trim($_POST['gender']));
    }
    if(empty($_POST['degree']))
    {
        $errors[] = 'select degree'; 
    }
    else
    {
        $degree = mysqli_real_escape_string($conn, trim($_POST['degree']));
    }
    if(empty($_POST['password']))
    {
        $errors[] = 'select password'; 
    }
    else
    {
        $password = mysqli_real_escape_string($conn, trim($_POST['password']));
    }
    if(empty($errors))
    {
        $query = "INSERT INTO lecturer (Le_ID, Le_Name, Le_Birthday, Le_Email, Le_Pass, Le_Gender, Le_Degree) VALUES (NULL,'$name','$birthday','$email','$password','$gender','$degree')";
        $r = @mysqli_query($conn ,$query);
  
        if($r)
        {
            echo "<script>
            alert('DONE');
            </script>"
            ;
            echo "<script type='text/javascript'> document.location = '../manage-lecturer.php' </script>";

        }
        else
        {
        ?>
            <div class="alert">
            <a href="login.php" class="closebtn" onclick="this.parentElement.style.display='none';">&times;</a> 
            <strong>SORRY ! </strong> User Name or Password is not correct.
            </div>
        <?php
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
    /*function printForm($first_name="", $last_name="" ,$email="")
     {*/

  ?>
  
  <form action="" method="post">
  <div class="login-root">
    <div class="box-root flex-flex flex-direction--column" style="min-height: 100vh;flex-grow: 1;">
      <div class="loginbackground box-background--white padding-top--64">
        
      </div>
      <div class="box-root padding-top--24 flex-flex flex-direction--column" style="flex-grow: 1; z-index: 9;">
      <div class="box-root padding-top--48 padding-bottom--24 flex-flex flex-justifyContent--center">
          <a href="../index.php"><img src="../../images/Logo.png"></a>
        </div>
        <div class="formbg-outer">
          <div class="formbg">
            <div class="formbg-inner padding-horizontal--48">
              <span class="padding-bottom--15">Add Lecturer</span>
              <form id="stripe-login">
                <div class="field padding-bottom--24">
                  <label for="name">Full Name</label>
                  <input type="text" name="name">
                </div>
                <div class="field padding-bottom--24">
                  <label for="birthday">Birth Day</label>
                  <input type="date" name="birthday" id="bdate" class="form-control" placeholder="Input Birhdate" autocomplete="off" >
                </div>
                <div class="field padding-bottom--24">
                  <label for="email">Email</label>
                  <input type="email" name="email">
                </div>
                <div class=" padding-bottom--24">
                <label>Gender</label>
                  <input class="redio" type="radio" name="gender" value="Male"> Male
                  <input class="redio" type="radio" name="gender" value="Famale">Famale
                </div>
                <div class=" padding-bottom--24">
                <label>Degree</label>
              
              <input class="redio" type="radio" name="degree" value="Prof.">Prof.</input>
              <input class="redio" type="radio" name="degree" value="Doctor">Doctor</input>
              <input class="redio" type="radio" name="degree" value="Master">Master</input>
              

            
                </div>
                <div class="field padding-bottom--24">
                  <div class="grid--50-50">
                    <label for="password">Password</label>
                    </div>
                  <input type="password" id="myInput" name="password">
                </div>
                <div class="field field-checkbox padding-bottom--24 flex-flex align-center">
                  <label for="checkbox">
                    <input type="checkbox"  onclick="myFunction()">Show Password
                  </label>
                </div>
                <div class="field padding-bottom--24">
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
  <script>
function myFunction() {
  var x = document.getElementById("myInput");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}

</script>
</body>


</html>