<?php
session_start();
include_once('../includes/conn.php');
$id = $_SESSION['id'];
$query = mysqli_query($conn, "SELECT * FROM admin WHERE Ad_ID=" . $id);
$result = mysqli_fetch_array($query);
if (strlen($_SESSION['id'] == 0)) {
  header('location:../outSession.php');
} else {
  if (isset($_GET['del'])) {
    mysqli_query($conn, "delete from subject where Su_ID =" . $_GET['id']);
    echo '<script>alert("Lecturer Record Deleted Successfully !!")</script>';
    echo '<script>window.location.href=manage-lecturer.php</script>';
  } ?>
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
                      <?php

                      $query = "SELECT subject.*, program.P_Name, department.* #, sub_lec.* , lecturer.*
                              FROM subject
                             # LEFT JOIN sub_lec on subject.Su_ID = sub_lec.Su_ID
                              LEFT JOIN program ON subject.P_ID = program.P_ID
                              LEFT JOIN department ON program.D_ID = department.D_ID
                             # LEFT JOIN lecturer ON lecturer.Le_ID = sub_lec.Le_ID
                               ";
                               
                      // $queryle = "SELECT sub_lec.*, lecturer.*, subject.*
                      //          from sub_lec 
                      //          inner join lecturer on lecturer.Le_ID = sub_lec.Le_ID
                      //          inner join subject on subject.Su_ID = sub_lec.Su_ID 
                               
                      //          ";
                      // $resLe = mysqli_query($conn, $queryle);
                      // // $rowCh = mysqli_fetch_assoc($queryCh);
                      // $rowle = mysqli_fetch_assoc($resLe);
                      //var_dump($queryle);
                      $result = mysqli_query($conn, $query);
                      if (mysqli_num_rows($result) > 0) {
                      ?>
                        <table class="table">
                          <thead>
                            <tr>
                              <th>No.</th>
                              <th>The Department</th>
                              <th>
                                <select class="form-control" onchange="getProgram()" style="display: ruby; width: 130px;" name="" id="program">
                                <option value="">All Program</option>
                                <?php $qP =mysqli_query($conn, "SELECT * from program ");
                                      while ($rP = mysqli_fetch_assoc($qP))
                                      {?>
                                        <option value="<?php echo $rP['P_ID']; ?>"><?php echo $rP['P_Name']; ?></option>
                                     <?php }

                                ?>
                              </select></th>
                              <th>Name</th>
                              <th>Semster</th>
                              <th>Chapter</th>
                              <!-- <th>The lecturer</th> -->
                              <th>Action
                                <select style="display: ruby; width: 300px;" class=" form-control" onchange="change()" name="" id="change">
                                  <option value="0">ALL</option>
                                  <option value="1">With Lecturer </option>
                                  <option value="2">With Out Lecturer</option>
                              </select></th>
                            </tr>
                          </thead>
                          <tbody id="table">
                            <?php
                            $i = 1;
                            while ($row = mysqli_fetch_assoc($result)) {
                              //var_dump($row);
                            ?>
                              <tr>
                                <td><?php echo $i; $i++ ?></td>
                                <td><?php echo $row['D_Name']; ?></td>
                                <td><?php echo $row['P_Name']; ?></td>
                                <td><?php echo $row['Su_Name']; ?></td>
                                <td><?php echo $row['semster']; ?></td>
                                <td><?php echo $row['Su_Chapter']; ?></td>
                                <!-- <td><?php #echo $row['Le_Name']; ?></td> -->
                                <td>
                                  <a href="edit-subject.php?id=<?php echo $row['Su_ID']; ?>&Did=<?php echo $row['D_ID']; ?>">
                                    <button class="btn btn-primary"><i class="fa fa-edit "></i> Edit</button> </a>

                                    <a href="add-lecturer-subject.php?id=<?php echo $row['Su_ID']; ?>">
                                    <button class="btn btn-outline-dark"><i class="fa fa-edit "></i> Lecturer</button> </a>

                                    <a href="add-cilo.php?id=<?php echo $row['Su_ID']; ?>">
                                    <button class="btn btn-outline-dark btn-"><i class="fa fa-edit "></i>CILOs</button> </a>


                                  <a href="add-chapter.php?id=<?php echo $row['Su_ID']; ?>">
                                    <button class="btn btn-outline-success"><i class="fa fa-edit "></i> Chapter</button> </a>

                                  
                                  <a href="manage-subject.php?id=<?php echo $row['Su_ID']; ?>&del=delete" onClick="return confirm('Are you sure you want to delete?')">
                                    <button class="btn btn-danger">Delete</button>
                                  </a>
                                </td>

                              </tr>
                          <?php
                            }
                          } else echo "You doesn't have any Subject"; ?>
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
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
    </div>
<script>
</script>
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
    <script src="js/ajax.js"></script>
    <script src="js/Chart.roundedBarCharts.js"></script>
  <?php } ?>
  <!-- End custom js for this page-->
  </body>

  </html>