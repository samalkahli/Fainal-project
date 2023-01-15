<?php 
include_once('../includes/conn.php');
$Sid = $_GET['id'];
$Chid = $_GET['cilos'];
$test = $Chid;

if ($test == 'Knowledge and Understanding' || $test == 'Intellectual Skills' || $test == 'Transferable Skills' )
{
    $query = "SELECT * FROM cilo where Su_ID = '$Sid' AND C_Title = '$Chid' ";

//var_dump($Chid, $test);
$result = mysqli_query($conn,$query);
$num = mysqli_num_rows($result);
if ($num > 0)
 {
while ($row = mysqli_fetch_assoc($result))
{
?>

<div class="field padding-bottom--24">
    <div class="h6" >
      
        <h6 class="h6" ><?php echo $row['C_Alias'];?></h6>
    </div>
    <h5>
    <span><?php echo $row['C_Text']; ?></span>
    </h5>
</div> 

<?php }

}
else {
?><h5>you don't have any CILOs in this chapter</h5>
<?php } 
}
else
{ 
$Chid = 'Professional & Practical Skills';
$query = "SELECT * FROM cilo where Su_ID = '$Sid' AND C_Title = '$Chid' ";

//var_dump($Chid , $query);
$result = mysqli_query($conn,$query);
$num = mysqli_num_rows($result);
if ($num > 0)
 {
while ($row = mysqli_fetch_assoc($result))
{
?>

<div class="field padding-bottom--24">
    <div class="h6" >
      
        <h6 class="h6" ><?php echo $row['C_Alias'];?></h6>
    </div>
    <h5>
    <span><?php echo $row['C_Text']; ?></span>
    </h5>
</div> 

<?php }

}
else {
?><h5>you don't have any CILOs in this chapter</h5>
<?php } }?>