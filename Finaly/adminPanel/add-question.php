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
    if (isset($_POST['xlsx'])) 
    {

        $target_dir = "files/question/";
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
            $ch = mysqli_real_escape_string($conn, trim($_POST['chapterCilos']));
            $headers = $xlsx->rows()[10];
            //var_dump($headers);
            $sheet = $xlsx->sheetsCount();
            for ($k = 0; $k < $sheet; $k++) {
                for ($i = 11; $i < count($xlsx->rows($k)); $i++) {
                    $she = $xlsx->sheetNames()[$k];
                    if ($she == 'Choices') {
                        $row = $xlsx->rows($k)[$i];
                        $query = "INSERT into question
                            (Qu_Text,  Qu_Type, Qu_A, Qu_B, Qu_C, Qu_D, Qu_Answer, Ch_ID) values
                            ('$row[0]','$row[1]','$she','$row[2]','$row[3]','$row[4]','$row[5]', $ch)";
                        $res = mysqli_query($conn, $query);
                        //var_dump($query);
                    } else {
                        $row = $xlsx->rows($k)[$i];
                        $query = "INSERT into question
                              (Qu_Text,  Qu_Type, Qu_Answer, Ex_ID) values ('$row[0]','$row[1]','$she', $ch)";
                        $res = mysqli_query($conn, $query);
                        //var_dump($query);
                    }
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
    if (isset($_POST['submit'])) {
        $Qid = $_POST['quee'];
        mysqli_query($conn, "delete from question where Qu_ID = $Qid");
        echo '<script>alert("Lecturer Record Deleted Successfully !!")</script>';
        //echo '<script>window.location.href=manage-lecturer.php</script>';
    }
    if (isset($_POST['new']))
     {
        //var_dump($_SESSION);
        $text =  '';
        $typeQ = '';
        $qA = null;
        $qB = null;
        $qC = null;
        $qD = null;
        $qAnswer = '';
        $errors = array();

        if (empty($_POST['question'])) {
            $errors[] = 'select question';
        } else {
            $text = mysqli_real_escape_string($conn, trim($_POST['question']));
        }
        if (empty($_POST['typeq'])) {
            $errors[] = 'select type';
        } else {
            $typeQ = mysqli_real_escape_string($conn, trim($_POST['typeq']));
        }
        if ($typeQ == 'Choices') {
            if (empty($_POST['a'])) {
                $errors[] = 'select cho A';
            } else {
                $qA = mysqli_real_escape_string($conn, trim($_POST['a']));
            }
            if (empty($_POST['b'])) {
                $errors[] = 'select cho B';
            } else {
                $qB = mysqli_real_escape_string($conn, trim($_POST['b']));
            }
            if (empty($_POST['c'])) {
                $errors[] = 'select cho C';
            } else {
                $qC = mysqli_real_escape_string($conn, trim($_POST['c']));
            }
            if (empty($_POST['d'])) {
                $errors[] = 'select cho D';
            } else {
                $qD = mysqli_real_escape_string($conn, trim($_POST['d']));
            }
        }
        if (empty($_POST['answer'])) {
            $errors[] = 'select answer';
        } else {
            $answer = mysqli_real_escape_string($conn, trim($_POST['answer']));
        }
        if (empty($errors)) {
            $query = "INSERT INTO question (Qu_Text, Qu_Type, Qu_A, Qu_B, Qu_C, Qu_D, Qu_Answer, Ex_ID) VALUES ('$text', '$typeQ' ,'$qA' ,'$qB' ,'$qC' ,'$qD' ,'$answer' ,$E_ID )";
            $resQ = mysqli_query($conn, $query);
            //var_dump($query);
            if ($resQ) {
                echo "<script>alert('Profile updated successfully');</script>";
                // echo "<script type='text/javascript'> document.location = 'manage-exam.php' </script>";
            }
        } else {
            echo '<h1> Error!</h1>
        <p calss="error">The following error(s) occurred:<br/>';
            foreach ($errors as $msg) {
                echo " - $msg <br>";
            }
            echo '</p><p>Plasse try again.</p><p><br /></p>';
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
                            <form method="POST" enctype="multipart/form-data" style="display: ruby;">
                                <div class="col-md-6" style="margin-top: 10px;">
                                    <div class="card">
                                        <div class="card-body ">
                                            <h4 class="card-title">Add Question
                                            </h4>
                                            <div>
                                                <div class="field padding-bottom--24">
                                                    <label for="name">Import the question from Excel File</label>
                                                    <input class="form-control" type="file" accept=".xls,.xlsx" name="fileToUpload" id="fileToUpload">
                                                    <span>if you want xlsx sheet<a href="download/question/AddQuestion.xlsx"> click here!</a></span>
                                                </div>
                                                <button class="btn btn-primary" name="lec" type="submit">add</button>
                                                <a data-bs-toggle="collapse" href="#div" aria-expanded="false" aria-controls="ui-basic">
                                                    <button class="menu-title btn btn-primary ">Add Manually</button>
                                                </a>

                                                <div class="collapse" id="div" style="margin: 20px;">

                                                    <div class="field padding-bottom--24">
                                                        <label>Type Of Question</label>
                                                        <select class="form-control" id="type" name="typeq" onchange="getType()">
                                                            <option value="">Select Type :</option>
                                                            <option value="True Or False">True Or False</option>
                                                            <option value="Choices">Choices</option>
                                                            <option value="Direct">Direct</option>
                                                        </select>
                                                    </div>
                                                    <div id="dropT">

                                                    </div>
                                                    <div class="field padding-bottom--24">
                                                        <input class="btn btn-primary" type="submit" name="new" value="Add Q">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
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
        <script src="js/Chart.roundedBarCharts.js"></script>
    <?php } ?>
    <!-- End custom js for this page-->
    </body>

    </html>