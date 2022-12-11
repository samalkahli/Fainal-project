<option value="0">Select department:</option>            
<?php 
include_once('../../includes/conn.php');
$id=$_GET['fact'];
$selCourse = mysqli_query($conn,"SELECT * FROM department where F_ID ='$id'");
while ($selCourseRow = mysqli_fetch_assoc($selCourse)){ ?>
<option value="<?php echo $selCourseRow['D_ID']; ?>"><?php echo $selCourseRow['D_Name']; ?></option>
<?php }
?>
