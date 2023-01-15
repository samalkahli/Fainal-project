<?php
session_start();
include_once('../includes/conn.php');
$id = $_SESSION['id'];
$query = mysqli_query($conn, "SELECT * FROM admin WHERE Ad_ID=" . $id);
$result = mysqli_fetch_array($query);
if (strlen($_SESSION['id'] == 0)) 
{
  header('location:../outSession.php');
} 
else 
{
  $leid = intval($_GET['id']);
  if (isset($_POST['submit'])) {


    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $birthday = $_POST['birthday'];
    $gender = $_POST['gender'];
    $degree = $_POST['degree'];

    $queryy = "UPDATE lecturer set
                        Le_Name ='$name',
                        Le_Birthday ='$birthday',
                        Le_Gender ='$gender',
                        Le_Degree ='$degree'
                        where
                        Le_ID ='$leid'";


    $res = mysqli_query($conn, $queryy);
    //var_dump($queryy,$res);
    if ($res) {
      echo "<script>alert('Profile updated successfully');</script>";
      //echo "<script type='text/javascript'> document.location = 'manage-lecturer.php'; </script>";
    }
  } else
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
                      <form method="post">
                        <?php
                        $query = "SELECT * FROM lecturer
                     where Le_ID ='$leid'";

                        $result = mysqli_query($conn, $query);
                        
                        if (mysqli_num_rows($result) > 0) { ?>
                          <table class="table">
                            <thead>
                              <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Birthday</th>
                                <th>Email</th>
                                <th>Gender</th>
                                <th>Degree</th>

                              </tr>
                            </thead>
                            <tbody>
                              <?php $i = 1;
                              $row = mysqli_fetch_assoc($result);

                              ?>
                              <tr>
                                <td><?php echo $i;
                                    $i++; ?></td>
                                <td><input class="form-control" name="name" type="text" value="<?php echo $row['Le_Name']; ?>" required /></td>
                                <td><input type="date" name="birthday" class="form-control" placeholder="Input Birhdate" autocomplete="off" value="<?php echo $row['Le_Birthday']; ?>" required /></td>
                                <td><?php echo $row['Le_Email']; ?></td>
                                <td>
                                  <select class="form-control" name="gender">
                                    <option value="<?php echo $row['Le_Gender']; ?>"><?php echo $row['Le_Gender']; ?></option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                  </select>
                                </td>
                                <td>
                                  <select class="form-control" name="degree">
                                    <option value="<?php echo $row['Le_Degree']; ?>"><?php echo $row['Le_Degree']; ?></option>
                                    <option value="Prof.">Prof.</option>
                                    <option value="Doctor">Doctor</option>
                                    <option value="Master">Master</option>
                                  </select>
                                </td>
                              </tr>
                            <?php
                          } else echo "You doesn't have any lecturer"; ?>
                            </tbody>

                          </table>
                          <!-- <a href="manage-lecturer.php" onClick="return confirm('Are you sure you want to update')"></a>  -->

                          <button name="submit" type="submit" class="btn btn-primary" onClick="return confirm('Are you sure you want to update')"><i class="fa fa-edit "></i> update</button>
                    </div>
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>
        </form>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->

        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <?php include('footer.php'); ?>

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
  <?php } ?>
  <!-- End custom js for this page-->
  </body>

  </html>