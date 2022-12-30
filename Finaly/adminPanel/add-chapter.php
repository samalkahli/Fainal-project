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
    // $Chid = intval($_GET['Chid']); 
    $Sid = intval($_GET['id']); 
    if (isset($_POST['submit']))
    {
        $topic = '';
        $sub = '';
        $chapter = '';
        $errors=array();
        if(empty($_POST['chapter']))
        {
            $errors[] = 'select chapter';
        }
        else
        {
            $chapter = mysqli_real_escape_string($conn, trim($_POST['chapter']));
        }
        if(empty($_POST['sub']))
        {
            $errors[] = 'select sub';
        }
        else
        {
            $sub = mysqli_real_escape_string($conn, trim($_POST['sub']));
        }
        if(empty($_POST['topic']))
        {
            $errors[] = 'select topic';
        }
        else
        {
            $topic = mysqli_real_escape_string($conn, trim($_POST['topic']));
        }
        if(empty($errors))
        {
            $query = " INSERT INTO chapter (Ch_Number, Ch_Topic, Ch_SupTopic, Su_ID ) VALUES ('$chapter', '$topic', '$sub', '$Sid')";
            $r = mysqli_query($conn ,$query);?>
            <script type='text/javascript'> document.location = "add-chapter.php?id="<?php echo $Sid; ?> </script><?php
            //var_dump($query);
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

    }
    else {
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
                    <form method="POST">
                    <?php
                        $query= "SELECT subject.*, program.P_Name, chapter.*
                        FROM subject
                        LEFT JOIN program ON subject.P_ID = program.P_ID 
                        left join chapter using (Su_ID)
                        where Su_ID = '$Sid'";

                          $result = mysqli_query($conn,$query);
                           // var_dump($row);
                          $row = mysqli_fetch_assoc($result); ?>
                      
                        <div class="field padding-bottom--24">
                          <label>The Subject</label>
                        <h5><?php echo $row['Su_Name'];?></h5>
                      </select>
                        
                        </div>
                        <div class="field padding-bottom--24">
                          <label>The Semster</label>
                              <h5><?php echo $row['semster'];?></h5>
                        </div>
                        <div class="field padding-bottom--24">
                        <label>Chapter Number </label>
                        <input type="number" name="chapter" id="chapter" onchange="getData('topic')" placeholder="Select the Chapter Number..." min="1" max="<?php echo $row['Su_Chapter']; ?>">
                        </div>
                        <h4 class="card-title">Add Chapter</h4>
                        <div class="field padding-bottom--24" id="drop">
                        </div>
                        <div class="field padding-bottom--24" >
                        <label>Sub Topic </label>
                            <input type="text" name="sub"  >
                        </div>  
                        
                        <button class="btn btnn btn-primary" type="submit" name="submit" >Continue</button>

                    </form>
                    </div>
                </div>
              </div>
            </div>








            <div class="col-md-6">
              <!-- here the code-->
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Information About Subject</h4>
                  <div class="table-responsive">
                  <form method="post">
                    <?php 
                    $query= "SELECT chapter.*, subject.*
                        FROM chapter
                        LEFT JOIN subject USING (Su_ID)
                        where Su_ID = '$Sid'  
                        ";

                          $result = mysqli_query($conn,$query);
                          $num = mysqli_num_rows($result);
                          //var_dump($num);
                            
                          if($num >0)
                          {
                         $row = mysqli_fetch_assoc($result);
                            ?>
                            
                              
                              <div class="field padding-bottom--24">
                                <label>The Chapter</label>
                                <input type="number" name="chapter" id="chapterNo" onchange="getData('subtopic')" title="Plase Select The Chapter" placeholder="Select The Chapter Number..." min="1" max="<?php echo $row['Su_Chapter'];?>">
                              </div>
                              <div id="sub" class="field padding-bottom--24">
                                 
                              </div>
                             <?php 
                             } else{echo "You don't have CILOs ";} ?>
                      
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
<?php include('footer.php');?>
  <!-- container-scroller -->

  <script>


  </script>

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