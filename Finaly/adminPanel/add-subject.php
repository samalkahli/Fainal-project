<?php 
session_start();
include_once('../includes/conn.php');
$id=$_SESSION['id'];
$query=mysqli_query($conn,"SELECT * FROM admin WHERE Ad_ID=".$id);
$result= mysqli_fetch_array($query);
use Shuchkin\SimpleXLSX;
if (strlen($_SESSION['id']==0))
  {
  header('location:../outSession.php');
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
    if (isset($_POST['add']))
    {
  
      $target_dir = "files/subjects/";
      $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
      //var_dump($_FILES["fileToUpload"]["name"]);
      $uploadOk = 1;
      $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
  
      // Check if image file is a actual image or fake image
          $check = filesize($_FILES["fileToUpload"]["tmp_name"]);
          if($check > 0) {
              //var_dump($check); 
              $uploadOk = 1;
          } else {
              echo'<script>al alert("File is not an xlsx."); </script>';
              $uploadOk = 0;
          }
          
      // Check if file already exists
      if (file_exists($target_file))
      {
        echo '<script> alert("Sorry, file already exists."); </script>';
          $uploadOk = 0;
      }
  
      // Check file size
      if ($_FILES["fileToUpload"]["size"] > 500000) {
         echo '<script> alert("Sorry, your file is too large.");</script>';
  
          $uploadOk = 0;
      }
  
      // Allow certain file formats
      if($imageFileType != "xlsx" ) {
        echo '<script>alert("Sorry, only JPG, JPEG, PNG & GIF files are allowed.");</script>';
          $uploadOk = 0;
      }
  
      // Check if $uploadOk is set to 0 by an error
      if ($uploadOk == 0) {
          echo '<script>alert("Sorry, your file was not uploaded.");</script>';
      // if everything is ok, try to upload file
      }
      
      else
      { 
        ini_set('error_reporting', E_ALL);
        ini_set('display_errors', true);
        require_once __DIR__.'/Read/SimpleXLSX.php';
        $xlsx = SimpleXLSX::parse($_FILES["fileToUpload"]["tmp_name"]);
        //var_dump($xlsx);
        $headers = $xlsx->rows()[10];
        $program = mysqli_real_escape_string($conn, trim($_POST['program']));
        
        //var_dump($headers);
        for($i = 11; $i < count( $xlsx->rows());$i++)
        {
            $row = $xlsx->rows()[$i];
            $query = "INSERT into subject (Su_Name, semster,Su_Chapter, P_ID) VALUES ('$row[0]','$row[1]','$row[2]','$program')";
            //echo $query."<br>";
            $res = mysqli_query($conn,$query);
            //var_dump($res);
        }
          //var_dump($_FILES["fileToUpload"]["tmp_name"]);
          if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file))
          { ?>   
            <script> alert("The file has been uploaded.");</script>
            <?php   
          }
          else
          {
              echo '<script>"Sorry, there was an error uploading your file."; </script>';
          }
      }
      
  
      }
  if(isset($_POST['submit']))
  {
    include_once('../includes/conn.php');
    $name='';
    $semster='';
    // $lecturer='';
    $number = '';
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
    // if(empty($_POST['lecturer']))
    // {
    //     $errors[] = 'select lecturer';
    // }
    // else
    // {
    //     $lecturer = mysqli_real_escape_string($conn, trim($_POST['lecturer']));
    // }
    
    if(empty($_POST['program']))
    {
        $errors[] = 'select program';
    }
    else
    {
        $program = mysqli_real_escape_string($conn, trim($_POST['program']));
    }
    if(empty($_POST['number']))
    {
        $errors[] = 'select number';
    }
    else
    {
        $number = mysqli_real_escape_string($conn, trim($_POST['number']));
    }
    
    if(empty($errors))
    {
        $query = "INSERT INTO subject (Su_Name, semster,Su_Chapter, P_ID) VALUES ('$name','$semster','$number','$program')";
        $r = @mysqli_query($conn ,$query);
  
        if($r)
        {
          echo "<script>alert('Profile updated successfully');</script>";
          echo "<script type='text/javascript'> document.location = 'manage-subject.php' </script>";

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
                  <form  method="post" enctype="multipart/form-data">
              <div class="field padding-bottom--24">
                  <label>Faculty</label>
                  
                  <select  class="form-control" name="faculty" id="fact" onchange="getData('dep')">
                    <option value="0">Select faculty:</option>
                    
                    <?php 
              include_once('../includes/conn.php');
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
                  <select  class="form-control" name="program" id="program" onchange="getSubject()">

                  </select>
                </div>
                <div id="dropS">

                </div>
                 
                        
                <div class="collapse" id="div" style="margin: 20px;">
                <div class="field padding-bottom--24">
                <label>Semster</label>
            <select class="form-control" name="semster">
              <option value="0">Select Semster</option>
              <option value="1">one</option>
              <option value="2">two</option>
              <option value="3">three</option>
              <option value="4">four</option>
              <option value="5">five</option>
              <option value="6">six</option>
              <option value="7">seven</option>
            </select>
                </div>
            
            <!-- <div class="field padding-bottom--24">
            <label>Lecturer</label>
            <select class="form-control" name="lecturer">
            <option value="0">Select Lecturer</option>
              <?php 
              // include_once('../../includes/conn.php');
              //   $selCourse = mysqli_query($conn,"SELECT * FROM lecturer ORDER BY Le_ID asc");
              //   while ($selCourseRow = mysqli_fetch_assoc($selCourse)){ ?>
                  <option value="<?php echo $selCourseRow['Le_ID']; ?>"><?php echo $selCourseRow['Le_Name']; ?></option>
                <?php # }
               ?>
            </select>
                </div> -->
                <div class="field padding-bottom--24">
                  <label for="name">Number Of Chapter</label>
                  <input type="number" name="number" max="7" min="1" value="1" placeholder="Chapter ..">
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
            <!-- </div> -->
              </form>
                  
                    </div>
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
                <?php }?>
  <!-- End custom js for this page-->
</body>
</html>