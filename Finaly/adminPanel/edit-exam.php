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
    $leid=intval($_GET['id']);
    if(isset($_POST['submit']))
    {
        

        $type=$_POST['type'];
        $time=$_POST['time'];
        
        $queryy="UPDATE exam set
                        Ex_type ='$type',
                        Ex_Duration ='$time',
                        Ex_Date =NOW()
                        where
                        Ex_ID ='$leid'";


        $res=mysqli_query($conn,$queryy);
    if($res)
    {
        echo "<script>alert('Profile updated successfully');</script>";
           echo "<script type='text/javascript'> document.location = 'manage-exam.php'; </script>";
            
    }

    
  }?>
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
            <div class="col-sm-12">
              <!-- here the code-->
              <div class="card">
                <div class="card-body">
                <h4 class="card-title">Subject Table</h4>
                  <div class="table-responsive">
                    <form method="post">
                  <?php
                    $query= "SELECT exam.*, subject.*
                    FROM exam
                    LEFT JOIN subject on exam.Su_ID = subject.Su_ID where Ex_ID='$leid'";

                      $result = mysqli_query($conn,$query);
                      if(mysqli_num_rows($result) > 0)
                      {
                        ?>
                <table class="table">
                  <thead>
                    <tr>
                      <th>No.</th>
                      <th>The program</th>
                      <th>Type Of Exam</th>
                      <th>Limit Time</th>
                      <th>Date Of Created</th>
                      
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                  $i=1;
                   while($row = mysqli_fetch_assoc($result))
                {?>
                    <tr>
                    <td><?php echo $i; $i++; ?></td>
                      <td><input class="form-control" name=program value="<?php echo $row['Su_Name'];?>" ></td>
                      <td>
                        <select class="form-control" name="type">
                        <option value="<?php echo $row['Ex_Type'];?>"><?php echo $row['Ex_Type'];?>
                        <option value="Sem Fainal">Sem Fainal</option>
                        <option value="Test">Test</option>
                        <option value="Fainal">Fainal</option> 

            </select>
                    </td>
                      <td>
                      <select class="form-control" name="time" required>
              <option value="<?php echo $row['Ex_Duration']; ?>"><?php echo $row['Ex_Duration']." Minutes"; ?></option>
              <option value="10">10 Minutes</option> 
              <option value="20">20 Minutes</option> 
              <option value="30">30 Minutes</option> 
              <option value="40">40 Minutes</option> 
              <option value="50">50 Minutes</option> 
              <option value="60">60 Minutes</option> 
            </select></td>
                      <td><?php echo $row['Ex_Date']; ?></td>
                      
                      
                      

                    </tr>
                    <?php
                  }

                  }
                  else echo "You doesn't have any Subject";?>
                            </tbody>
                    </table>
                    </table>
                    <button name="submit" type="submit"  class="btn btn-primary"  onClick="return confirm('Are you sure you want to update')"><i class="fa fa-edit "></i> update</button> 

                  </div>
                </form>

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


