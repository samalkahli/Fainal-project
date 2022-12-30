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
    include_once('../includes/conn.php');
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
            
          
            echo "<script>alert('DONE');</script>";
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
                  <form id="stripe-login" method="post">
                <div class="field padding-bottom--24">
                  <label for="name">Name The Facukty</label>
                  <input type="text" name="name">
                </div>
               
                <div class="field padding-bottom--19">
                <div class="formbg-inner">

                  <input class="btn btn-primary" type="submit" name="submit" value="Continue">
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
  </div>

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