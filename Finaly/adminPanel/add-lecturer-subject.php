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
        $Suid = $_GET['id'];
        $queryLe =mysqli_query($conn, "UPDATE subject set
                    status = 'active'
                    where Su_ID = '$Suid'");
        $querysu = "SELECT *
                    FROM sub_lec
                    where Su_ID = '$Suid'";
        $resultsu =mysqli_query($conn,$querysu);
        $row = mysqli_fetch_assoc($resultsu);
        $num = mysqli_num_rows($resultsu);
        if ($num > 0)
        { ?>
            <script>alert('This Subject have Lecturer Try Another Subject ');</script>
            <script type='text/javascript'> document.location = 'select-lecturer.php'; </script>

           
       <?php }
       else {
        
        
        if(isset($_POST['submit']))
        {
             $le = $_POST['lecturer'];
             $query = " INSERT INTO sub_lec (Su_ID, Le_ID) values ('$Suid','$le')";
             $result = mysqli_query($conn,$query);
             //var_dump($result);

        //mysqli_query($conn,"INSERT into sub_lec (Le_ID, Su_ID) VALUES ('$le', '$su')");
        echo '<script>alert("Lecturer Record  Successfully !!")</script>';
        echo "<script type='text/javascript'> document.location = 'manage-subject.php'; </script>";

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
              <form method="POST">
              <div class="card">
                <div class="card-body">
                <h4 class="card-title">Subject Table</h4>
                  <div class="table-responsive">
                  <?php
                  
                  $query = "SELECT subject.*, program.P_Name, department.* #, sub_lec.* , lecturer.*
                  FROM subject
                 # LEFT JOIN sub_lec on subject.Su_ID = sub_lec.Su_ID
                  LEFT JOIN program ON subject.P_ID = program.P_ID
                  LEFT JOIN department ON program.D_ID = department.D_ID
                 # LEFT JOIN lecturer ON lecturer.Le_ID = sub_lec.Le_ID
                 where Su_ID = '$Suid'
                   ";
                      $result = mysqli_query($conn,$query);


                    //   $queryle = " SELECT subject.* ,sub_lec.* ,lecturer.*
                    //   from sub_lec 
                    //    LEFT JOIN subject ON sub_lec.Su_ID = subject.Su_ID
                    //    LEFT JOIN lecturer ON sub_lec.Le_ID = lecturer.Le_ID 
                    //    where Su_ID = 
                    //   ";
                    //   $resultle = mysqli_query($conn,$queryle);
                      if(mysqli_num_rows($result) > 0)
                      {
                        ?>
                <table class="table">
                  <thead>
                    <tr>
                      <th>No.</th>
                      <th>The Department</th>
                      <th>The Program</th>
                      <th>Name</th>
                      <th>Semster</th>
                      <th>Chapter</th>
                      <th>The lecturer</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                  $i=1;
                //   $rowle = mysqli_fetch_assoc($resultle);
                   while($row = mysqli_fetch_assoc($result))
                { 
                 // var_dump($row);?>
                    <tr>
                      <td><?php echo $row['Su_ID']; ?></td>
                      <td><?php echo $row['D_Name']; ?></td>
                      <td><?php echo $row['P_Name']; ?></td>
                      <td><?php echo $row['Su_Name']; ?></td>
                      <td><?php echo $row['semster']; ?></td>
                      <td><?php echo $row['Su_Chapter'];?></td>
                      <td><select class="form-control" name="lecturer" id="">
                        <?php
                      $queryLe = mysqli_query($conn,"SELECT * from lecturer ");
                      var_dump($queryLe);
                         while ($rowLe = mysqli_fetch_assoc($queryLe))
                        { 
                            //var_dump($rowLe);?>
                            <option value="<?php echo $rowLe['Le_ID']; ?>"><?php echo $rowLe['Le_Name']; ?></option>
                  <?php } ?>
                      </select>
                    </td>  
                      <td>
                        <input class="btn btn-outline-primary btn-sm" type="submit" name="submit" value="ADD">
                      </td>

                    </tr>
                    <?php
                  }

                  }
                  else echo "You doesn't have any Subject";?>
                            </tbody>
                    </table>
                  </div>
                </div>
              </div>
              </form>
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


