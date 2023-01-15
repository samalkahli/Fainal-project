<?php
session_start();
include_once('../includes/conn.php');
$id = $_SESSION['id'];
$query = mysqli_query($conn, "SELECT * FROM admin WHERE Ad_ID=" . $id);
$result = mysqli_fetch_array($query);
use Shuchkin\SimpleXLSX;    
if (strlen($_SESSION['id'] == 0)) {
  header('location:../outSession.php');
} else {
  $Sid = intval($_GET['id']);

  if (isset($_POST['submit'])) {
    $title = '';
    $alias = '';
    $text = '';
    // $chapter = '';
    // $C = '';
    $errors = array();
    if (empty($_POST['title'])) {
      $errors[] = 'select title';
    } else {
      $title = mysqli_real_escape_string($conn, trim($_POST['title']));
    }

    if (empty($_POST['alias'])) {
      $errors[] = 'select alias';
    } else {
      $alias = mysqli_real_escape_string($conn, trim($_POST['alias']));
    }
    if (empty($_POST['text'])) {
      $errors[] = 'select text';
    } else {
      $text = mysqli_real_escape_string($conn, trim($_POST['text']));
    }
    // if (empty($_POST['chapter'])) {
    //   $errors[] = 'select chapter';
    // } else {
    //   $chapter = mysqli_real_escape_string($conn, trim($_POST['chapter']));
    // }
    // if (empty($_POST['subtopic'])) {
    //   $errors[] = 'select subtopic';
    // } else {
    //   $C = mysqli_real_escape_string($conn, trim($_POST['subtopic']));
    // }
    if (empty($errors)) {
      $query = " INSERT INTO cilo (C_Title, C_Alias,C_Text, Su_ID ) VALUES ('$title', '$alias', '$text', '$Sid')";
      $r = mysqli_query($conn, $query);
      //var_dump($query);
      if ($r) {
        echo "<script>alert('DONE');</script>";
        echo "<script type='text/javascript'> document.location = document.location</script>";
      }
    } else {
      echo '<h1> Error!</h1>
      <p calss="error">The following error(s) occurred:<br/>';
      foreach ($errors as $msg) {
        echo " - $msg<br />\n";
      }
      echo '</p><p>Plasse try again.</p><p><br /></p>';
    }
  }
  if (isset($_POST['add'])) {

    $target_dir = "files/cilos/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    //var_dump($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    $check = filesize($_FILES["fileToUpload"]["tmp_name"]);
    if ($check > 0) {
        //var_dump($check); 
        $uploadOk = 1;
    } else {
        echo '<script>al alert("File is not an xlsx."); </script>';
        $uploadOk = 0;
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        echo '<script> alert("Sorry, file already exists."); </script>';
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 500000) {
        echo '<script> alert("Sorry, your file is too large.");</script>';

        $uploadOk = 0;
    }

    // Allow certain file formats
    if ($imageFileType != "xlsx") {
        echo '<script>alert("Sorry, only JPG, JPEG, PNG & GIF files are allowed.");</script>';
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo '<script>alert("Sorry, your file was not uploaded.");</script>';
        // if everything is ok, try to upload file
    } else {
        ini_set('error_reporting', E_ALL);
        ini_set('display_errors', true);
        require_once __DIR__ . '/Read/SimpleXLSX.php';
        $xlsx = SimpleXLSX::parse($_FILES["fileToUpload"]["tmp_name"]);
        //var_dump($xlsx);
        $headers = $xlsx->rows()[10];
        //var_dump($headers);
        $sheet = $xlsx->sheetsCount();
        for ($k = 0; $k < $sheet; $k++) {
          $s = 1;
            for ($i = 11; $i < count($xlsx->rows($k)); $i++) {
                $she = $xlsx->sheetNames()[$k];
                    $row = $xlsx->rows($k)[$i];
                    $query = "INSERT INTO cilo (C_Title, C_Alias,C_Text, Su_ID ) VALUES
                        ('$she','$row[0]$s','$row[1]', $Sid)";
                    $res = mysqli_query($conn, $query);
                    $s++;
                    //var_dump($query);
                
            }
        }
        //var_dump($_FILES["fileToUpload"]["tmp_name"]);
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) { ?>
            <script>
                alert("The file has been uploaded.");
            </script>
<?php
        } else {
            echo '<script>"Sorry, there was an error uploading your file."; </script>';
        }
    }
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
                      <form method="post" enctype="multipart/form-data">
                        <?php
                        $query = "SELECT subject.*, program.P_Name
                        FROM subject
                        LEFT JOIN program ON subject.P_ID = program.P_ID 
                        where Su_ID = '$Sid'";

                        $result = mysqli_query($conn, $query);
                        //var_dump($row);
                        while ($row = mysqli_fetch_assoc($result)) { ?>

                          <div class="field padding-bottom--24">
                            <label>The Subject</label>
                            <h5><?php echo $row['Su_Name']; ?></h5>
                            </select>

                          </div>
                          <div class="field padding-bottom--24">
                            <label>The Semster</label>
                            <h5><?php echo $row['semster']; ?></h5>
                          </div>
                          <h4 class="card-title">Add CILOs</h4>
                          <div class="field padding-bottom--24">
                            <label for="name">Import the question from Excel File</label>
                            <input class="form-control" type="file" accept=".xls,.xlsx" name="fileToUpload" id="fileToUpload">
                            <span>if you want xlsx sheet<a href="download/cilos/AddCilos.xlsx"> click here!</a></span>
                          </div>
                          <button class="btn btn-primary" name="add" type="submit">add</button>
                          <a data-bs-toggle="collapse" href="#div" aria-expanded="false" aria-controls="ui-basic">
                            <button class="menu-title btn btn-primary ">Add Manually</button>
                          </a>
                          <div class="collapse" id="div" style="margin: 20px;">
                            <div class="field padding-bottom--24">

                              <label>Title of CILOs </label>
                              <select class="form-control" name="title" >
                                <option value="">Select The Title :</option>
                                <option value="Knowledge and Understanding">Knowledge and Understanding</option>
                                <option value="Intellectual Skills">Intellectual Skills</option>
                                <option value="Professional & Practical Skills">Professional & Practical Skills</option>
                                <option value="Transferable Skills">Transferable Skills</option>
                              </select>
                            </div>
                            <div class="field padding-bottom--24">
                              <label>Alias</label>
                              <select class="form-control" name="alias" >
                                <option value="">Select The Alias :</option>
                                <option value="a">a</option>
                                <option value="b">b</option>
                                <option value="c">c</option>
                                <option value="d">d</option>
                              </select>
                            </div>
                            <!-- <div class="field padding-bottom--24">
                            <label>Select The Chapter </label>
                            <input type="number" name="chapter" id="chapterNo" onchange="getData('subTCILO')" placeholder="Select The Chapter Number..." min="1" max="<?php echo $row['Su_Chapter']; ?>" required>
                          </div> -->
                            <div id="sub">

                            </div>
                            <div class="field padding-bottom--24">
                              <label>Text of CILOs </label>
                              <input type="text" name="text">
                            </div>

                          <?php

                        } ?>
                          <button name="submit" type="submit" class="btn btnn btn-primary"><i class="fa fa-edit "></i> update</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>








            <div class="col-md-6">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Manage CILOs</h4>
                  <div class="table-responsive">
                    <form method="post">
                      <?php
                        $que = "SELECT cilo.*#, chapter.*
                                FROM cilo
                                /* LEFT JOIN chapter on chapter.Ch_ID = cilo.Ch_ID */
                                ";

                      $result = mysqli_query($conn, $que);
                      $num = mysqli_num_rows($result);
                      //var_dump($result);

                      if ($num > 0) {
                        $row = mysqli_fetch_assoc($result);
                      ?>

                        
                        <div class="field padding-bottom--24">
                          <label>The Title</label>
                          <select class="form-control" name="" id="cilos" onchange="getData('title')">
                          <option value="0">Select The Title :</option>
                                <option value="Knowledge and Understanding">Knowledge and Understanding</option>
                                <option value="Intellectual Skills">Intellectual Skills</option>
                                <option value="Professional & Practical Skills">Professional & Practical Skills</option>
                                <option value="Transferable Skills">Transferable Skills</option>
                              </select>
                        </div>
                        <div id="drop" class="field padding-bottom--24">

                        </div>

                      <?php
                                        } else {
                                          echo "You don't have CILOs ";
                                        } ?>

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