<option value="0">Select subject:</option>            
<?php 
include_once('../../includes/conn.php');
$idPro=$_GET['program'];
$sem=$_GET['semster'];
$selCourse = mysqli_query($conn,"SELECT * FROM subject where P_ID ='$idPro' AND semster = '$sem'");
while ($selCourseRow = mysqli_fetch_assoc($selCourse)){ ?>
<option value="<?php echo $selCourseRow['Su_ID']; ?>"><?php echo $selCourseRow['Su_Name']; ?></option>
<?php }
?>
