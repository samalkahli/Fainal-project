<?php
include_once('../includes/conn.php');
$chapter = $_GET['chid'];
$id = $_GET['id'];
$query = mysqli_query($conn, "SELECT * from chapter where Ch_Number = '$chapter' and Su_ID = '$id'");
$row = mysqli_fetch_assoc($query); 
//var_dump($query);
$num = mysqli_num_rows($query);
if ($num == 0)
{?>
    <div id="other" class="field padding-bottom--24">
    <label>New Topic </label>
    <input type="text" name="topic" value="" required > 
    </div>
<?php } 
else{
?>


    <label>The Topic to Chapter <?php echo $row['Ch_Number']; ?> </label>
    <input type="text" name="topic" value="<?php echo $row['Ch_Topic'];?>" style="border: 0px;" readonly> 
    <?php }?>
