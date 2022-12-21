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
    $Sid = intval($_GET['id']); 
    if (isset($_POST['submit']))
    {
        $title = '';
        $alias = '';
        $text='';
        $chapter = '';
        $errors=array();
        if(empty($_POST['title']))
        {
            $errors[] = 'select title';
        }
        else
        {
            $title = mysqli_real_escape_string($conn, trim($_POST['title']));
        }
        if(empty($_POST['alias']))
        {
            $errors[] = 'select alias';
        }
        else
        {
            $alias = mysqli_real_escape_string($conn, trim($_POST['alias']));
        }
        if(empty($_POST['text']))
        {
            $errors[] = 'select text';
        }
        else
        {
            $text = mysqli_real_escape_string($conn, trim($_POST['text']));
        }
        if(empty($_POST['chapter']))
        {
            $errors[] = 'select chapter';
        }
        else
        {
            $chapter = mysqli_real_escape_string($conn, trim($_POST['chapter']));
        }
        if(empty($errors))
        {
            $query = " INSERT INTO cilo (C_Title, C_ALias, C_Text, C_Chapter, Su_ID ) VALUES ('$title', '$alias', '$text', '$chapter', '$Sid')";
            $r = mysqli_query($conn ,$query);
        if($r)
        {
            echo "<script>alert('DONE');</script>";
            echo "<script type='text/javascript'> document.location = 'manage-subject.php' </script>";
        }
        
    }   
    else
    {
      echo '<h1> Error!</h1>
      <p calss="error">The following error(s) occurred:<br/>';
      foreach ($errors as $msg)
      {
        echo " - $msg<br />\n";
      }
      echo '</p><p>Plasse try again.</p><p><br /></p>';  
    }

    mysqli_close($conn);
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
                  <h4 class="card-title">Information About Subject</h4>
                  <div class="table-responsive">
                    <form method="post">
                    <?php
                        $query= "SELECT subject.*, program.P_Name
                        FROM subject
                        LEFT JOIN program ON subject.P_ID = program.P_ID 
                        where Su_ID = '$Sid'";

                          $result = mysqli_query($conn,$query);
                          $row=mysqli_num_rows($result);

                          if($row> 0)
                          {
                            //var_dump($row);
                          while($row = mysqli_fetch_assoc($result))
                            {?>
                      
                        <div class="field padding-bottom--24">
                          <label>The Subject</label>
                        <h5><?php echo $row['Su_Name'];?></h5>
                      </select>
                        
                        </div>
                        <div class="field padding-bottom--24">
                          <label>The Semster</label>
                              <h5><?php echo $row['semster'];?></h5>
                        </div>
                        <h4 class="card-title">Add CILOs</h4>

                        <div class="field padding-bottom--24">

                            <label>Title of CILOs </label>
                            <input type="text" name="title" >
                        </div>
                        <div class="field padding-bottom--24">
                            <label>Alias</label>
                            <select class="form-control" name="alias" required>
                            <option value="">Select The Alias :</option>
                            <option value="a">a</option>
                            <option value="b">b</option>
                            <option value="c">c</option>
                            <option value="d">d</option>
                          </select>
                        </div>
                        <div class="field padding-bottom--24">
                            <label>Select The Chapter </label>
                            <input type="number" name="chapter" value="1" min="1" max="8" >
                        </div>
                        <div class="field padding-bottom--24">
                            <label>Text of CILOs </label>
                            <input type="text" name="text" >
                        </div>
                        
                        <?php
                      }

                      }
                      else echo "You doesn't have any Subject";?>
                    <button name="submit" type="submit"  class="btn btnn btn-primary" ><i class="fa fa-edit "></i> update</button> 
                    </form>
                    </div>
                </div>
              </div>
            </div>








            <div class="col-md-6">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title" >Manage CILOs</h4>
                  <div class="table-responsive">
                    <form method="post"><?php 
                    $query= "SELECT cilo.*, subject.*
                        FROM cilo
                        LEFT JOIN subject USING (Su_ID)
                        where Su_ID = '$Sid'  
                        ";

                          $result = mysqli_query($conn,$query);
                          $num = mysqli_num_rows($result);
                          //var_dump($row);
                            
                          if($num >0)
                          {
                         $row = mysqli_fetch_assoc($result);
                            ?>
                            
                              <div id="drop" class="field padding-bottom--24">
                                 
                              </div>
                              <div class="field padding-bottom--24">
                                <label>The Chapter</label>
                                    <input type="number" name="chapter" id="chapter" onchange="getData('title')" title="Plase Select The Chapter" value="0" min="1" max="8">
                              </div>
                              
                             <?php 
                             } else{echo "tytyt";} ?>
                      
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