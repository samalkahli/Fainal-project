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
    if(isset($_POST['submit']))
    {
        $leid=intval($_GET['id']);

        $name=$_POST['name'];
        $birthday=$_POST['birthday'];
        $gender=$_POST['gender'];
        $degree=$_POST['degree'];
        $semster=$_POST['semster'];
        $Sname=$_POST['Sname'];
        $queryy="UPDATE lecturer set
                        Le_Name ='$name',
                        Le_Birthday ='$birthday',
                        Le_Gender ='$gender',
                        Le_Degree ='$degree'
                        where
                        Le_ID ='$leid'";


        $res=mysqli_query($conn,$queryy);
    if($res)
    {
        echo "<script>alert('Profile updated successfully');</script>";
           echo "<script type='text/javascript'> document.location = 'manage-lecturer.php'; </script>";
            
    }
    mysql_close($conn);
    }
    else
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
    <nav class="navbar default-layout col-lg-12 col-12 p-0 d-flex align-items-top flex-row pt-5 mt-3">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
        <div class="me-3">
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-bs-toggle="minimize">
            <span class="icon-menu"></span>
          </button>
        </div>
        <div>
          <a class="navbar-brand brand-logo" href="index.html">
            <img src="images/logo.svg" alt="logo">
          </a>
          <a class="navbar-brand brand-logo-mini" href="index.html">
            <img src="images/logo-mini.svg" alt="logo">
          </a>
        </div>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-top"> 
        <ul class="navbar-nav">
          <li class="nav-item font-weight-semibold d-none d-lg-block ms-0">
            <h1 class="welcome-text">Good Morning, <span class="text-black fw-bold"><?php echo $result['Ad_Name']  ?></span></h1>
          </li>
        </ul>
        <ul class="navbar-nav ms-auto">
          
          
          <li class="nav-item">
            <form class="search-form" action="#">
              <i class="icon-search"></i>
              <input type="search" class="form-control" placeholder="Search Here" title="Search here">
            </form>
          </li>
          <li class="nav-item dropdown d-none d-lg-block user-dropdown">
            <a class="nav-link" id="UserDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
              <img class="img-xs rounded-circle" src="images/faces/face8.jpg" alt="Profile image"> </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
            
              <a class="dropdown-item"><i class="dropdown-item-icon mdi mdi-account-outline text-primary me-2"></i> My Profile <span class="badge badge-pill badge-danger">1</span></a>
              <a class="dropdown-item" href="../outSession.php"><i class="dropdown-item-icon mdi mdi-power text-primary me-2"></i>Sign Out</a>
            </div>
          </li>
        </ul>
       
      </div>
    </nav>
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
                    $query= "SELECT
                    Le_ID,
                    Le_Name,
                    Le_Birthday,
                    Le_Gender,
                    Le_Email,
                    Le_Degree
                     FROM lecturer t1
                      ";

                      $result = mysqli_query($conn,$query);
                      if(mysqli_num_rows($result)> 0)
                      {?>
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
                  <?php while($row = mysqli_fetch_assoc($result))
                {?>
                    <tr>
                    <td><?php echo $row['Le_ID']; ?></td>
                      <td><input class="form-control" name="name" type="text" value="<?php echo $row['Le_Name']; ?>" required /></td>
                      <td><input type="date" name="birthday"  class="form-control" placeholder="Input Birhdate" autocomplete="off" value="<?php echo $row['Le_Birthday']; ?>" required /></td>
                      <td><?php echo $row['Le_Email']; ?></td>
                      <td><select class="form-control" name="gender">
              <option value="0"><?php echo $row['Le_Gender']; ?></option>
              <option value="male">Male</option>
              <option value="female">Female</option>
            </select></td>
                      <td>
            <select class="form-control" name="degree">
            <option value="0"><?php echo $row['Le_Degree'];?></option>
            <option value="Prof.">Prof.</option>
            <option value="Doctor">Doctor</option>
            <option value="Master">Master</option></select></td>
                   </tr>
                    <?php
                  }

                  }
                  else echo "You doesn't have any lecturer";?>
                            </tbody>
                            
                    </table>
                   <!-- <a href="manage-lecturer.php" onClick="return confirm('Are you sure you want to update')"></a>  -->
                   
                        <button name="submit" type="submit"  class="btn btn-primary"  onClick="return confirm('Are you sure you want to update')"><i class="fa fa-edit "></i> update</button> 
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


