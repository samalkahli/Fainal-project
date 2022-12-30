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
  else{ 
        if(isset($_GET['del']))
        {
        mysqli_query($conn,"delete from lecturer where Le_ID = '".$_GET['id']."'");
        echo '<script>alert("Lecturer Record Deleted Successfully !!")</script>';
        echo '<script>window.location.href=manage-lecturer.php</script>';
        }
        if(isset($_GET['pass']))
      {
        $password="Lecturer.123";
        $newpass = $password;
              mysqli_query($conn,"UPDATE lecturer set Le_Pass=SHA1('$newpass') where Le_ID = '".$_GET['id']."'");
              echo '<script>alert("Password Reset. New Password is Lecturer.123")</script>';
        echo '<script>window.location.href=manage-students.php</script>';
      } 
              ?>
<!DOCTYPE html>
<html lang="en">

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
    
    <!-- partial:partials/_navbar.html -->
    <?php include('head.php'); ?>
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
            <div class="col-sm-12">
              <!-- here the code-->
              <div class="card">
                <div class="card-body">
                <h4 class="card-title">Lecturer Table</h4>
                  <div class="table-responsive">
                  <?php
                    $query= "SELECT * FROM lecturer";

                      $result = mysqli_query($conn,$query);
                      if(mysqli_num_rows($result)> 0)
                      {?>
                <table class="table">
                  <thead>
                    <tr>
                      <th>No.</th>
                      <th>Name</th>
                      <th>Birthday</th>
                      <th>Email</th>
                      <th>Gender</th>
                      <th>Degree</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                  $i=1;
                  while($row = mysqli_fetch_assoc($result))
                  {?>
                    <tr>
                    <td><?php echo $i; $i++; ?></td>
                      <td><?php echo $row['Le_Name']; ?></td>
                      <td><?php echo $row['Le_Birthday']; ?></td>
                      <td><?php echo $row['Le_Email']; ?></td>
                      <td><?php echo $row['Le_Gender']; ?></td>
                      <td><?php echo $row['Le_Degree']; ?></td>
                      
                      <td>
                      <a href="edit-lecturer.php?id=<?php echo $row['Le_ID'];?>">
                        <button class="btn btn-primary"><i class="fa fa-edit "></i> Edit</button> </a>                                        
                      <a href="manage-lecturer.php?id=<?php echo $row['Le_ID']; ?>&del=delete" onClick="return confirm('Are you sure you want to delete?')">
                        <button class="btn btn-danger">Delete</button>
                      </a>
                      <a href="manage-lecturer.php?id=<?php echo $row['Le_ID']?>&pass=update" onClick="return confirm('Are you sure you want to reset password?')">
                        <button type="submit" name="submit" id="submit" class="btn btn-secondary" >Reset Password</button>
                      </a>
                      </td>

                    </tr>
                    <?php
                  }

                  }
                  else echo "You doesn't have any lecturer";?>
                            </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
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


