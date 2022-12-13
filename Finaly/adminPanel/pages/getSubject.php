<option value="0">Select subject:</option>            
<?php 
include_once('../../includes/conn.php');
$idPro=$_GET['program'];
$selCourse = mysqli_query($conn,"SELECT * FROM subject where P_ID ='$idPro'");
while ($selCourseRow = mysqli_fetch_assoc($selCourse)){ ?>
<option value="<?php echo $selCourseRow['Su_ID']; ?>"><?php echo $selCourseRow['Su_Name']; ?></option>
<?php }
?>
