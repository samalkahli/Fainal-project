<?php
include_once('../includes/conn.php');
$que = $_GET['que'];
$cil = $_GET['cil'];
$queryLink = "SELECT question.*, cilo.* , cilo_que.*
from cilo_que
left join cilo on cilo.C_ID = cilo_que.C_ID
left join question on question.Qu_ID = cilo_que.Qu_ID
where cilo_que.C_ID = '$cil' and question.Ch_ID = '$que'";
$resLink = mysqli_query($conn,$queryLink);
//var_dump($resLink);
if ($num = mysqli_num_rows($resLink) > 0)
{
    $i = 1;
    while ($row = mysqli_fetch_assoc($resLink))
    {?>
        <h4 class="padding-bottom--24"><?php echo $i.' - '.$row['Qu_Text']; ?></h4>
        <input type="text" name="idLink[]" value="<?php echo $row['CQu_ID']; ?>" style="display: none;">
        <input type="text" name="idQu[]" value="<?php echo $row['Qu_ID']; ?>" style="display: none;">
        
    <?php $i++; }?>
    <button type="submit" name="delLink" class="btn btn-danger">DELETE</button> 
    <?php 
}
else {

$query = "SELECT * from question where Ch_ID = '$que' AND status = 'noactive'";
$res = mysqli_query($conn,$query);

while ($row = mysqli_fetch_assoc($res))
{?><div>
   <h4><input class="checkbox" type="checkbox" name="ques[]" id="" value="<?php echo $row['Qu_ID']; ?>"> <?php echo $row['Qu_Text'];?></h4>
</div><br><?php } ?>

<input class="btn btn-primary btn-sm" type="submit" name="link" value="Link Cilos With Question">
<?php } ?>

 
  
  
