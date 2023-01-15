<?php
session_start();
include_once('../includes/conn.php');
$id = $_SESSION['id'];
$query = mysqli_query($conn, "SELECT * FROM admin WHERE Ad_ID=" . $id);
$result = mysqli_fetch_array($query);

use Shuchkin\SimpleXLSX;

if (strlen($_SESSION['id'] == 0)) {
  header('location:../outSession.php');
} else {
  if (isset($_POST['submit'])) 
  {
    $name = '';
    $birthday = '';
    $email = '';
    $gender = '';
    $degree = '';
    $password = '';
    $errors = 1;
    if (empty($_POST['name'])) {?>
       <script>alert('Select Name');</script><?php
       $errors = 0 ; 
    } 
    else if ($errors == 1) 
    {
      $name = mysqli_real_escape_string($conn, trim($_POST['name']));
      $errors = 2 ;
    }
    if (empty($_POST['birthday'])) 
    {?>
      <script>alert('Select Birthday');</script><?php
      $errors = 0 ;
    } 
    else if ($errors == 2)  {
      $birthday = mysqli_real_escape_string($conn, trim($_POST['birthday']));
      $errors = 3 ;
    }
    if (empty($_POST['email'])) 
    {?>
      <script>alert('Select Email');</script><?php
      $errors = 0 ;
    } 
    elseif ($errors == 3)  
    {
      $email = mysqli_real_escape_string($conn, trim($_POST['email']));
      $errors = 4 ;
    }
    if (empty($_POST['gender'])) 
    {?>
      <script>alert('Select Gender');</script><?php
      $errors = 0 ;
    } 
    else if ($errors == 4)  
    {
      $gender = mysqli_real_escape_string($conn, trim($_POST['gender']));
      $errors = 5;
    }
    if (empty($_POST['degree'])) {?>
      <script>alert('Select Degree');</script><?php
      $errors = 0 ;
    } 
    else if ($errors == 5) 
    {
      $degree = mysqli_real_escape_string($conn, trim($_POST['degree']));
      $errors = 6 ;
    }
    if (empty($_POST['password'])) {?>
      <script>alert('Select Password');</script><?php
      $errors = 0 ;
    } 
    else if ($errors == 6)  
    {
      $password = mysqli_real_escape_string($conn, trim($_POST['password']));
      $errors = 7 ;
    }
    if ($errors == 7) 
    {
      $query = "INSERT INTO lecturer (Le_ID, Le_Name, Le_Birthday, Le_Email, Le_Pass, Le_Gender, Le_Degree) VALUES (NULL,'$name','$birthday','$email',SHA1('$password'),'$gender','$degree')";
      $r = mysqli_query($conn, $query);
      //var_dump($r);
      if ($r) {
        echo "<script>
            alert('The Lecturer added Successfully');
            </script>";
        echo "<script type='text/javascript'> document.location = 'manage-lecturer.php' </script>";
      } else {
?>
        <script>alert('This Email Already Exists');</script>
      <?php
      }
    } 
    
  }
  if (isset($_POST['lec'])) {

    $target_dir = "files/lecturer/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    //var_dump($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    $check = filesize($_FILES["fileToUpload"]["tmp_name"]);
    if ($check > 0) {
      //var_dump($check); 
      $uploadOk = 1;
    } else {
      echo '<script>al alert("File is not an xlsx."); </script>';
      $uploadOk = 0;
    }

    // Check if file already exists
    if (file_exists($target_file)) {
      echo '<script> alert("Sorry, file already exists."); </script>';
      $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 500000) {
      echo '<script> alert("Sorry, your file is too large.");</script>';
      $uploadOk = 0;
    }

    // Allow certain file formats
    if ($imageFileType != "xlsx") {
      echo '<script>alert("Sorry, only JPG, JPEG, PNG & GIF files are allowed.");</script>';
      $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
      echo '<script>alert("Sorry, your file was not uploaded.");
      document.location = document.location </script>';
      // if everything is ok, try to upload file
    } else {
      ini_set('error_reporting', E_ALL);
      ini_set('display_errors', true);
      require_once __DIR__ . '/Read/SimpleXLSX.php';
      $xlsx = SimpleXLSX::parse($_FILES["fileToUpload"]["tmp_name"]);
      //var_dump($xlsx);
      $headers = $xlsx->rows()[10];
      //var_dump($headers);

      for ($i = 11; $i < count($xlsx->rows()); $i++) {
        $row = $xlsx->rows()[$i];
        $query = "INSERT into lecturer (Le_Name, Le_Birthday, Le_Email, Le_Pass, Le_Gender, Le_Degree)
         values ('$row[0]','$row[1]','$row[2]',SHA1('$row[3]'),'$row[4]','$row[5]')";
        //echo $query."<br>";
        $res = mysqli_query($conn, $query);
        //var_dump($res);
      }
      //var_dump($_FILES["fileToUpload"]["tmp_name"]);
      if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) { ?>
        <script>
          alert("The file has been uploaded.");
        </script>
                 <script type="text/javascript">document.location = document.location </script>

    <?php
      } else {?>
        <script>alert("Sorry, there was an error uploading your file")</script>
         <script type="text/javascript">document.location = document.location </script>
        <?php
      }
    }
  } else {
    /*function printForm($first_name="", $last_name="" ,$email="")
     {*/

    ?>


    <head>
      <html lang="en">

      <head>
        <!-- meta tags -->
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
                      <h4 class="card-title">Information About Lecturer</h4>
                      <div class="table-responsive">
                        <div class="formbg-outer">
                          <div class="formbg">
                            <form method="post" enctype="multipart/form-data">
                              <h4 class="padding-bottom--15">Add Lecturer</h4>
                              <div class="field padding-bottom--24">
                                <h4 for="name">Import the Lecturer from Excel File </h4>
                                <input class="form-control" type="file" accept=".xls,.xlsx" name="fileToUpload" id="fileToUpload">
                                <span>if you want xlsx sheet<a href="download/lecturer/AddLecturer.xlsx"> click here!</a></span>
                              </div>
                              <button class="btn btn-primary" name="lec" type="submit">add</button>
                              <a data-bs-toggle="collapse" href="#div" aria-expanded="false" aria-controls="ui-basic">
                                <button class="menu-title btn btn-primary ">Add Manually</button>
                              </a>
                              <div class="collapse" id="div" style="margin: 20px;">
                                <div class="field padding-bottom--24">
                                  <h4 for="name">Full Name</h4>
                                  <input type="text" name="name">
                                </div>
                                <div class="field padding-bottom--24">
                                  <h4 for="birthday">BirthDay</h4>
                                  <input type="date" name="birthday" id="bdate" class="form-control" placeholder="Input Birhdate" autocomplete="off">
                                </div>
                                <div class="field padding-bottom--24">
                                  <h4 for="email">Email</h4>
                                  <input type="email" name="email">
                                </div>
                                <div class=" padding-bottom--24">
                                  <h4>Gender : </h4><br>
                                  <div class="male" style="margin-bottom: 18;">
                                    <input class="radio" type="radio" name="gender" value="Male"> Male
                                  </div>
                                  <input class="redio" type="radio" name="gender" value="Famale">Famale
                                </div>
                                <div class=" field padding-bottom--24">
                                  <h4>Degree : </h4> <br>
                                  <select class="form-control" name="degree" id="degree" onchange="get()">
                                    <option value="0">select the degree :</option>
                                    <option value="Prof.">Prof.</option>
                                    <option value="Doctor">Doctor</option>
                                    <option value="Master">Master</option>
                                    <option value="1"> Other </option>
                                  </select>
                                </div>
                                <div id="other" class="field padding-bottom--24">

                                </div>

                                <div class="field padding-bottom--24">
                                  <div class="grid--50-50">
                                    <h4 for="password">Password</h4>
                                  </div>
                                  <input type="password" id="myInput" name="password">
                                </div>
                                <div class=" field-checkbox padding-bottom--24 flex-flex align-center">
                                  <h4 for="checkbox">
                                    <input type="checkbox" onclick="myFunction()">Show Password
                                  </h4>
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
              </div>

              <!-- main-panel ends -->
            </div>
          </div>
        </div>
      </div>

      <?php include('footer.php'); ?>
      <!-- page-body-wrapper ends -->

      <!-- container-scroller -->

<script>
  
</script>
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
  <?php }
} ?>
  <!-- End custom js for this page-->
    </body>

    </html>