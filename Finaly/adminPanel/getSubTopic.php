<?php
include_once('../includes/conn.php');
$chapter = $_GET['chapterid'];
$id = $_GET['id'];
$query = mysqli_query($conn, "SELECT * from chapter where Ch_Number = '$chapter'and Su_ID = '$id'");
$row = mysqli_fetch_assoc($query); 

$num = mysqli_num_rows($query);
$i = 1;
if ($num > 0)
{?>
    <div class="field padding-bottom--24">
    <label><b>Name The Topic is : </b></label><br>
    <label><?php echo $row['Ch_Topic'];?></label><br>
    <label> <b> Name The SubTopics is : </b></label><br>
    <?php $q = mysqli_query($conn,"SELECT Ch_SupTopic from chapter where Ch_Number = '$chapter 'and Su_ID = '$id'");
    //var_dump($q);
    while ($r = mysqli_fetch_assoc($q)) { ?>
    <label><?php echo $i.' - '.$r['Ch_SupTopic']; $i++;?></label><br>
    <?php }?>
    </div>
<?php } 
else{ echo "you don't have any topics and subtopics"; }?>
