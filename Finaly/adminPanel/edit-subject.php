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
    $Did=intval($_GET['Did']);
    if(isset($_POST['submit']))
    {
        
        $name=$_POST['name'];
        $prog=$_POST['program'];
        $semster=$_POST['semster'];
        $chapter=$_POST['chapter'];
        $lecturer=$_POST['lecturer'];
        
        $queryy="UPDATE subject set
                        Su_Name ='$name',
                        semster ='$semster',
                        Su_Chapter='$chapter',
                       # Le_ID ='$lecturer',
                        P_ID= '$prog'
                        where
                        Su_ID ='$leid'";


        $res=mysqli_query($conn,$queryy);
    if($res)
    {
        echo "<script>alert('Profile updated successfully');</script>";
           echo "<script type='text/javascript'> document.location = 'manage-subject.php'; </script>";
            
    }

    
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
                <form method="post">
                <h4 class="card-title">Subject Table</h4>
                  <div class="table-responsive">
                  <form method="post">
      
                  <?php
                    $query= "SELECT subject.*, program.P_Name
                    FROM subject 
                      LEFT JOIN program ON subject.P_ID = program.P_ID 
                      #LEFT JOIN lecturer on subject.Le_ID = lecturer.Le_ID 
                      where Su_ID = '$leid'";

                      $result = mysqli_query($conn,$query);
                      ?>
                <table class="table">
                  <thead>
                    <tr>
                      <th>No.</th>
                      <th>The program</th>
                      <th>Name</th>
                      <th>Semster</th>
                      <th>Chapter</th>
                      <!-- <th>The lecturer</th> -->
                      
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                  $i=1;
                   while($row = mysqli_fetch_assoc($result))
                {?>
                    <tr>
                    <td><?php echo $i; $i++; ?></td>
                    <td><select class="form-select" name="program">
                        <option value="<?php echo $row['P_ID'];?>"><?php echo $row['P_Name'];?></option>
                        <?php $queryP = " SELECT * FROM program where D_ID='$Did'  ";
                                $resP = mysqli_query($conn,$queryP);
                                while ($rowP = mysqli_fetch_assoc($resP)) {
                                ?>
                        <option value="<?php echo $rowP['P_ID'];?>"><?php echo $rowP['P_Name'];?></option>
                                <?php } ?>
                        </select></td>

                      <td><input name="name" class="form-control" value="<?php echo $row['Su_Name']; ?>" required /></td>
                      <td>
                        <select class="form-select" name="semster">
                          <option  value="<?php echo $row['semster'];?>"><?php echo $row['semster'];?></option>
                          <option value="1">one</option>
                          <option value="2">two</option>
                          <option value="3">three</option>
                          <option value="4">four</option>
                          <option value="5">five</option>
                          <option value="6">six</option>
                          <option value="7">seven</option>
                        </select>
                      </td>
                      <td>
                        <input class="form-control" type="number" name="chapter" value="<?php echo $row['Su_Chapter']; ?>" max="7" min="1" >
                      </td>
                      <!-- <td>
                        <select class="form-select" name="lecturer">

                          <?php $queryLe = " SELECT * FROM lecturer ";
                                $resLe = mysqli_query($conn,$queryLe);
                                while ($rowLe = mysqli_fetch_assoc($resLe)) {
                                ?>
                        <option value="<?php echo $rowLe['Le_ID'];?>"><?php echo $rowLe['Le_Name'];?></option>
                                <?php } ?>
                      </td> -->
                    
                    
                    </tr>
                    <?php
                  

                  }?>

                  </tbody>
                    </table>
                    <button name="submit" type="submit"  class="btn btn-primary"  onClick="return confirm('Are you sure you want to update')"><i class="fa fa-edit "></i> update</button> 

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
</form>
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


