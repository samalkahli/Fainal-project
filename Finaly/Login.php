<html>
<head>
  <meta charset="utf-8">
  <title>Sign in</title>
  <link rel="stylesheet" type="text/css" href="css\styleLogin.css">

</head>

<body>
  <?php
  session_start();
  if(isset($_POST['submit']))
  {
    include_once('includes/conn.php');
    $password=$_POST['password'];
    $useremail = $_POST['email'];
    $ret= mysqli_query($conn,"SELECT * FROM admin WHERE Ad_Email='$useremail' and Ad_Pass='$password'");
    $num=mysqli_fetch_array($ret);
    if($num>0)
    {

      $_SESSION['id']=$num['Ad_ID'];
      $_SESSION['name']=$num['Ad_Name'];
      header('location:adminPanel/index.php');

    }
    else
    {
      $res = array("res" => "invalid");
    } 
    
  }
  else
   {

  ?>
  <form action="" id="adminLoginFrm" method="post">
  <div class="login-root">
    <div class="box-root flex-flex flex-direction--column" style="min-height: 100vh;flex-grow: 1;">
      <div class="loginbackground box-background--white padding-top--64">
      </div>
      <div class="box-root padding-top--24 flex-flex flex-direction--column" style="flex-grow: 1; z-index: 9;">
        <div class="box-root padding-top--48 padding-bottom--24 flex-flex flex-justifyContent--center">
          <a href=""><img src="images/Logo.png"></a>
          </div>
        <div class="formbg-outer">
          <div class="formbg">
            <div class="formbg-inner padding-horizontal--48">
              <span class="padding-bottom--15">Sign in to your account</span>
              <form id="stripe-login">
                <div class="field padding-bottom--24">
                  <label for="email">Email</label>
                  <input type="email" name="email">
                </div>
                <div class="field padding-bottom--24">
                  <div class="grid--50-50">
                    <label for="password">Password</label>
                    
                  </div>
                  <input type="password" id="myInput" name="password">
                </div>
                <div class="field field-checkbox padding-bottom--24 flex-flex align-center">
                  <label for="checkbox">
                    <input type="checkbox"  onclick="myFunction()">Show Password
                  </label>
                </div>
                <div class="field padding-bottom--24">
                  <input type="submit" name="submit" value="Continue">
                </div>
              </div>
              </form>
            </div>
          </div>
         
        </div>
      </div>
    </div>
  </div>
    </form>
  <?php }?>
<script>
function myFunction() {
  var x = document.getElementById("myInput");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>
</body>


</html>