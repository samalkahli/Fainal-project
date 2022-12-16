<option value="0">Select program:</option>            
<?php 
include_once('../../includes/conn.php');
$idPro=$_GET['department'];
$selCourse = mysqli_query($conn,"SELECT * FROM program where D_ID ='$idPro'");
while ($selCourseRow = mysqli_fetch_assoc($selCourse)){ ?>
<option value="<?php echo $selCourseRow['P_ID']; ?>"><?php echo $selCourseRow['P_Name']; ?></option>
<?php }
?>
