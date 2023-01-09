<?php 
session_start();
include_once('../includes/conn.php');
$id=$_SESSION['id'];
$query=mysqli_query($conn,"SELECT * FROM admin WHERE Ad_ID=".$id);
$result= mysqli_fetch_array($query);
if (strlen($_SESSION['id']==0))
  {
  header('location:../outSession.php');
  }
  else{ ?>
    <html>
    <head>
      <meta charset="utf-8">
      <title>Sign in</title>  
      <script src="js/jquery.js"></script>
      <script><?php include_once("js/ajax.js")?></script>
    
    </head>
    
    <body>
    <?php

  if(isset($_POST['submit']))
  {
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
        $query = "INSERT INTO lecturer (Le_ID, Le_Name, Le_Birthday, Le_Email, Le_Pass, Le_Gender, Le_Degree) VALUES (NULL,'$name','$birthday','$email',SHA1('$password'),'$gender','$degree')";
        $r = @mysqli_query($conn ,$query);
  
        if($r)
        {
            echo "<script>
            alert('The Lecturer added Successfully');
            </script>"
            ;
            echo "<script type='text/javascript'> document.location = 'manage-lecturer.php' </script>";

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
  

<head>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Star Admin2 </title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="vendors/feather/feather.css">
  <link rel="stylesheet" href="vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="vendors/typicons/typicons.css">
  <link rel="stylesheet" href="vendors/simple-line-icons/css/simple-line-icons.css">
  <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
  <!-- <link rel="stylesheet" type="text/css" href="..\css\styleLogin.css"> -->

  <script src="js/ajax.js"> </script>
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="vendors/datatables.net-bs4/dataTables.bootstrap4.css">
  <link rel="stylesheet" href="js/select.dataTables.min.css">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="css/vertical-layout-light/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="images/favicon.png" />
</head>
<body>
    
  <div class="container-scroller">
  <?php include('head.php'); ?>
    <!-- partial:partials/_navbar.html -->
    
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_settings-panel.html -->
      
      
      <!-- partial -->
      <!-- partial:partials/_sidebar.html -->
      <?php include('sidebar.php'); ?>
      <!-- partial -->
      
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
         
            <div class="col-md-6">
              <!-- here the code-->
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Information About Subject</h4>
                  <div class="table-responsive">
                  <form action="" method="post">
  
                  <div class="formbg-outer">
                    <div class="formbg">
                    <span class="padding-bottom--15">Add Lecturer</span>
                    <form id="stripe-login">
                      <div class="field padding-bottom--24">
                        <label for="name">Full Name</label>
                        <input type="text" name="name" required>
                      </div>
                      <div class="field padding-bottom--24">
                        <label for="birthday">BirthDay</label>
                        <input type="date" name="birthday" id="bdate" class="form-control" placeholder="Input Birhdate" autocomplete="off" required>
                      </div>
                      <div class="field padding-bottom--24">
                        <label for="email">Email</label>
                        <input type="email" name="email" required>
                      </div>
                      <div class=" padding-bottom--24">
                      <label>Gender : </label><br>
                       <div class="male" style="margin-bottom: 18;"> <input class="radio" type="radio" name="gender" value="Male" required> Male </div>
                        <input class="redio" type="radio" name="gender" value="Famale" required>Famale
                      </div>
                      <div class=" field-checkbox padding-bottom--24">
                      <label>Degree : </label><br style="margin: 20px;">
                    <select class="form-control" name="degree" id="degree" onchange="get()">
                      <option value="0">select the degree :</option>
                      <option value="Prof." >Prof.</option>
                      <option value="Doctor">Doctor</option>
                      <option value="Master" >Master</option>
                      <option value="1" > Other </option>
                    </select>  
                      </div>
                      <div id="other" class="field padding-bottom--24" >
                       
                      </div>
                    
                      <div class="field padding-bottom--24">
                        <div class="grid--50-50">
                          <label for="password">Password</label>
                          </div>
                        <input type="password" id="myInput" name="password">
                      </div>
                      <div class=" field-checkbox padding-bottom--24 flex-flex align-center">
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
      
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->

  <!-- container-scroller -->
  <?php include('footer.php');?>

  <!-- plugins:js -->
  <script src="vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="vendors/chart.js/Chart.min.js"></script>
  <script src="vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
  <script src="vendors/progressbar.js/progressbar.min.js"></script>

  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="js/off-canvas.js"></script>
  <script src="js/hoverable-collapse.js"></script>
  <script src="js/template.js"></script>
  <script src="js/settings.js"></script>
  <script src="js/todolist.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="js/jquery.cookie.js" type="text/javascript"></script>
  <script src="js/dashboard.js"></script>
  <script src="js/Chart.roundedBarCharts.js"></script>
                <?php } }?>
  <!-- End custom js for this page-->
</body>
</html>