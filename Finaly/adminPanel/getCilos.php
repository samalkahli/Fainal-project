<script>
$(document).ready(function(){
  $("#text").mouseenter(function(){
    $(".div").show();

  });
  $("#text").mouseleave(function(){
    $(".div").hide();
  });
});
</script>
<option value="0"> Select The CILOs </option> 
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
<option id="text"><?php echo $row['C_Alias'].$i; $i++?></option> 

<?php }?>
<h5 class="div"  >
<span class="div"><?php echo $row['C_Text']; ?></span>
</h5>
<?php }
else {
?><h5>you don't have any CILOs in this chapter</h5>
<?php } ?>