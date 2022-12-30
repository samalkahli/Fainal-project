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
    $S_ID=intval($_GET['id']); 
    $E_ID=intval($_GET['e_id']);
    $D_ID=intval($_GET['d_id']);
    if(isset($_POST['submit']))
    {
        

        $type= $_POST['type'];
        $time= $_POST['time'];
        $subject=$_POST['subject'];
        //$semster= $_POST['semster'];
        
        $queryy="UPDATE exam set
                        Ex_type ='$type',
                        Ex_Duration ='$time',
                        Ex_Date =NOW(),
                        Su_ID ='$subject'
                        where
                        Ex_ID ='$leid'";


        $res=mysqli_query($conn,$queryy);
    if($res)
    {
        echo "<script>alert('Profile updated successfully');</script>";
           echo "<script type='text/javascript'> document.location = 'manage-exam.php'; </script>";
        //echo var_dump($res);
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
  <script src="js/ajax.js"></script>
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
                  <h4 class="card-title">Subject Table</h4>
                  <div class="table-responsive">
                    <form method="post">
                    <?php
                        $query= "SELECT exam.*, subject.*
                        FROM exam
                        LEFT JOIN subject on exam.Su_ID = subject.Su_ID  
                        where Ex_ID='$E_ID'";

                          $result = mysqli_query($conn,$query);
                          if(mysqli_num_rows($result) > 0)
                          {
                            ?>
             
                        <div class=" field padding-bottom--24">
                          <label>The program</label>
                          <select class="form-control" name="program" id="program" onchange="getData('sub')">
                            <?php
                            $getP=mysqli_query($conn,"SELECT * FROM program where D_ID='$D_ID' ");
                            while ($rows = mysqli_fetch_assoc($getP))
                            {?>
                              <option value="<?php echo $rows['P_ID'];?>"><?php echo $rows['P_Name'];?></option>
                            <?php }?>
                            </select>
                        </div>
                        <?php
                          while($row = mysqli_fetch_assoc($result))
                      {?>
                        <div class="field padding-bottom--24">
                          <label>The Semster</label>
                          <select class="form-control" name="semster" id="semster" onchange="getData('sem')">
                              <option value="<?php echo $row['semster'];?>"><?php echo $row['semster'];?></option>
                              <option value="1">one</option>
                              <option value="2">two</option>
                              <option value="3">three</option>
                              <option value="4">four</option>
                              <option value="5">five</option>
                              <option value="6">six</option>
                              <option value="7">seven</option>
                            </select>
                        </div>
                      
                        <div class="field padding-bottom--24">
                          <label>The Subject</label>
                      <select  class="form-control" name="subject" id="subject" >
                        <option value="<?php echo $row['Su_ID'];?>"><?php echo $row['Su_Name'];?></option>
                      </select>
                        
                        </div>
                        <div>
                        <div class="field padding-bottom--24">

                            <label>Type Of Exam</label>
                            <select class="form-control" name="type">
                              <option value="<?php echo $row['Ex_Type'];?>"><?php echo $row['Ex_Type'];?>
                              <option value="Sem Fainal">Sem Fainal</option>
                              <option value="Test">Test</option>
                              <option value="Fainal">Fainal</option> 
                            </select>
                        </div>
                        <div class="field padding-bottom--24">
                            <label>Limit Time</label>
                            <select class="form-control" name="time" required>
                            <option value="<?php echo $row['Ex_Duration']; ?>"><?php echo $row['Ex_Duration']." Minutes"; ?></option>
                            <option value="10">10 Minutes</option> 
                            <option value="20">20 Minutes</option> 
                            <option value="30">30 Minutes</option> 
                            <option value="40">40 Minutes</option> 
                            <option value="50">50 Minutes</option> 
                            <option value="60">60 Minutes</option> 
                          </select>
                        </div>
                        <div class="field padding-bottom--24">
                            <label>Date Of Created :</label><br>
                            <label> <?php echo $row['Ex_Date'];?></label>
                        </div>
                        <?php
                      }

                      }
                      else echo "You doesn't have any Subject";?>
                    <button name="submit" type="submit"  class="btn btnn btn-primary"  onClick="return confirm('Are you sure you want to update')"><i class="fa fa-edit "></i> update</button> 
                  </div>
                    </div>
                </div>
              </div>
            </div>







            <div class="col-md-6" style="margin-top: 10px;">
              <div class="card">
                <div class="card-body "> 
                <h4 class="card-title">Add Question 
                        <a data-bs-toggle="collapse" href="#div" aria-expanded="false" aria-controls="ui-basic">
                         <button class="menu-title btn btn-primary btn-sm">Add Questionn</button>
                        </a>
                </h4>
                        <div>
                          <?php $query=" SELECT * FROM quation where Ex_ID = $E_ID "; 
                          $res = mysqli_query($conn,$query);
                          // $num = mysqli_num_rows($res);
                          // if ($num > 0)
                          // {

                          // }
                          // else
                          // {
                          //   echo "You don't have any Question";
                          // }
                          
                          
                          ?>
                        </div>
                        <div class="collapse" id="div" style="margin: 20px;">
                        <div class="field padding-bottom--24">
                        <label for="name">Import the question from Excel File</label>
                        <input type="file" accept=".xls,.xlsx" class="form-control" >
                        </div>
                        <div class="field padding-bottom--24">  
                        <label for="name">Chapter's</label>
                          <input type="number" name="chapter" id="chapter" onchange="getData('cilo')" title="Plase Select The Chapter" value="0" min="1" max="8">
                        </div>
                        <div class="field padding-bottom--24">  
                          <label>Select The CILOs</label>
                        <select id="drop" class="form-control" name="cilos">

                        </select>
                        </div>
                        <div class="field padding-bottom--24">
                          <label for="name">The Question</label>
                          <input type="text" name="question">
                        </div>
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


