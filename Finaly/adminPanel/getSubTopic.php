<?php
include_once('../includes/conn.php');
$chapter = $_GET['chapterid'];
$query = mysqli_query($conn, "SELECT * from chapter where Ch_Number = '$chapter'");
$row = mysqli_fetch_assoc($query); 
//var_dump($query);
$num = mysqli_num_rows($query);

if ($num > 0)
{?>
    <div class="field padding-bottom--24">
    <label><b>Name The Topic is : </b></label><br>
    <label><?php echo $row['Ch_Topic'];?></label><br>
    <label> <b> Name The SubTopics is : </b></label><br>
    <label><?php $q = mysqli_query($conn,"SELECT Ch_SupTopic from chapter where Ch_Number = '$chapter'");
    while ($r = mysqli_fetch_assoc($q)) { 
     echo $r['Ch_SupTopic'];?></label><br>
    <?php }?>
    </div>
<?php } 
else{ echo "you don't have any topics and subtopics"; }?>
