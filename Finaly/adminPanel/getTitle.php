<?php 
include_once('../includes/conn.php');
$Sid = $_GET['id'];
$Chid= $_GET['chid'];
$query = "SELECT * FROM cilo where Su_ID = '$Sid' AND C_Chapter = '$Chid' ";
$i = 1;
$result = mysqli_query($conn,$query);
$num = mysqli_num_rows($result);
if ($num > 0)
 {
while ($row = mysqli_fetch_assoc($result))
{
?>
<label>The Title</label>
<h4><?php echo $row['C_Title'];?></h4>
<div class="field padding-bottom--24">
    <div class="h6" >
      
        <h6 class="h6" ><?php echo $row['C_Alias'].$i; $i++;?></h6>
    </div>
    <h5>
    <span><?php echo $row['C_Text']; ?></span>
    </h5>
</div> 

<?php }

}
else {
?><h5>you don't have any CILOs in this chapter</h5>
<?php } ?>