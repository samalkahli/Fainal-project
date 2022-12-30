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
  else ?>
<!DOCTYPE html>
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
    <?php include('head.php');?>
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
                  <h4 class="card-title">Basic Table</h4>
                  <div class="table-responsive">
                  <?php
                      $query= "SELECT `faculty`.*, `department`.*, `program`.*
                      FROM `faculty` 
                        LEFT JOIN `department`
                         ON `department`.`F_ID` = `faculty`.`F_ID` 
                        LEFT JOIN `program`
                         ON `program`.`D_ID` = `department`.`D_ID`";
                       $result = mysqli_query($conn,$query);
                      if(mysqli_num_rows($result)> 0)
                      {?>
                <table class="table">
                  <thead>
                    <tr>
                      <th>Faculty <a class="mdi mdi-border-color" href="manage-faculty.php"></a></th>
                      <th>Department <a class="mdi mdi-border-color" href="manage-department.php"></a></th>
                      <th>Program <a class="mdi mdi-border-color" href="manage-program.php"></a></th>
                      
                    </tr>
                  </thead>
                  <tbody>
                  <?php while($row = mysqli_fetch_assoc($result))
                {?>
                    <tr>
                      <td><?php echo @$row['F_Name']; ?></td>
                      <td><?php echo @$row['D_Name']; ?></td>
                      <td><?php echo @$row['P_Name']; ?></td>
                    </tr>
                    <?php
                  }

                  }
                  else echo "you don't have any data";?>
                            </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
       
        <!-- partial -->
      </div>
      <footer class="bg-light text-center text-lg-start">
  <!-- Copyright -->
  <div class="text-end p-4" style="background-color: rgba(0, 0, 0, 0.2);">
    © 2020 Copyright:
    <img  src="../images/Logo.png" style="height: 50px; width: auto;">
  </div>
  <!-- Copyright -->
</footer>
      <!-- main-panel ends -->
    </div>
    
    <!-- page-body-wrapper ends -->
  </div>
  
  <!-- container-scroller -->

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

  <!-- End custom js for this page-->
</body>
</html>


