<?php 
session_start();
include_once('../../includes/conn.php');
$id=$_SESSION['id'];
$query=mysqli_query($conn,"SELECT * FROM admin WHERE Ad_ID=".$id);
$result= mysqli_fetch_array($query);
if (strlen($_SESSION['id']==0))
  {
    header('location:../../outSession.php');
  }
  else{ ?>
<html>
<head>
  <meta charset="utf-8">
  <title>Sign up</title>
  <link rel="stylesheet" type="text/css" href="../../css/styleLogin.css">
  <script language="javascript" type="text/javascript">
    </script>
  <script src="../js/jquery.js"></script>

    
  <script><?php include_once("../js/ajax.js")?></script>

    
</head>

<body>
<div class="app-main__outer">
    <div id="refreshData">
    <div class="app-main__inner">
  <?php
  #include(include_once('includes/config.php'));
  if(isset($_POST['submit']))
  {
    $fuid=$_POST['department'];
    $errors = array();
    $department ='';
    $program='';
    if(empty($_POST['department']))
    {
      $errors[] = 'YOU forget to enter your first name.';
    }
    else
    {
      $department = mysqli_real_escape_string($conn, trim($_POST['department']));
    }
    if(empty($_POST['program']))
    {
      $errors[] = 'YOU forget to enter your last name.';
    }
    else
    {
      $program = mysqli_real_escape_string($conn, trim($_POST['program']));
    }

    
    if(empty($errors))
    {
    
      $query = "INSERT INTO `program` (`P_ID`, `P_Name`, D_ID) VALUES (NULL, '$program','$fuid')";
      $r = mysqli_query($conn ,$query);
      
      
      
      if($r)
      {
      echo "<script>alert('DONE');</script>";
      echo "<script type='text/javascript'> document.location = '../index.php'; </script>";

      #echo "<script type='text/javascript'> document.location = 'q-page.php?id=".mysqli_insert_id($conn)."'; </script>";
      }
    
      else
      {
        echo '<h1>System Error</h1>
        <p class="error">you could not be registered due to a system error. We apologize for any inconvence.</p>';
        echo '<p>'. mysqli_error($conn).'<br/><br/>Query: '.$query.'</p>';


      }
      mysqli_close($conn);
      exit();
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
  
  else 
  {

    
  
  ?>
  <form action="" method="post">
  <div class="login-root">
    <div class="box-root flex-flex flex-direction--column" style="min-height: 100vh;flex-grow: 1;">
      <div class="loginbackground box-background--white padding-top--64">
        <div class="loginbackground-gridContainer">
          <div class="box-root flex-flex" style="grid-area: top / start / 8 / end;">
            
          </div>
         
        </div>
      </div>
      <div class="box-root padding-top--24 flex-flex flex-direction--column" style="flex-grow: 1; z-index: 9;">
        <div class="box-root padding-top--48 padding-bottom--24 flex-flex flex-justifyContent--center">
          <a href="../index.php"><img src="../../images/Logo.png"></a>
        </div>
        <div class="formbg-outer">
          <div class="formbg">
            <div class="formbg-inner padding-horizontal--48">
              <span class="padding-bottom--15">Regster the Program</span>
              <form id="stripe-login">
                <div class="field padding-bottom--24">
                  <label>Faculty</label>
                  
                  <select  class="form-control" name="faculty" id="fact" onchange="getData('dep')">
                    <option value="0">Select faculty:</option>
                    
                    <?php 
              include('../../includes/conn.php');
                $selCourse = mysqli_query($conn,"SELECT * FROM faculty ORDER BY F_ID asc");
                while ($selCourseRow = mysqli_fetch_assoc($selCourse)){ ?>
                  <option value="<?php echo $selCourseRow['F_ID']; ?>"><?php echo $selCourseRow['F_Name']; ?></option>
                <?php }
               ?>
            </select>
                </div>
                <div class="field padding-bottom--24">
                  <label for="Last Name">Department</label>
                  <select  class="form-control" name="department" id="department">
                   

                  </select>
                </div>
                <div class="field padding-bottom--24">
                  <label for="email">program</label>
                  <input  class="form-control" name="program">
                  
                </div>
                
                <div class="field padding-bottom--24">
                  <input type="submit" name="submit" value="Continue">
                </div>
                <span> <a href="../index.php">back</a></span>
          </div>
              </form>
            </div>
          </div>
          
      </div>
    </div>
  </div>
</form>
  <?php } }?>
</body>

</html>