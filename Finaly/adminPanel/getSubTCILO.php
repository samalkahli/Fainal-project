<?php
include_once('../includes/conn.php');
$chapter = $_GET['chapterid'];
$id = $_GET['id'];
$query = mysqli_query($conn, "SELECT * from chapter where Ch_Number = '$chapter'and Su_ID = '$id'");
$row = mysqli_fetch_assoc($query); 
//var_dump($id);
$num = mysqli_num_rows($query);
?>
<input type="text" id="x" value="<?php echo $chapter; ?>" hidden>
<?php
if ($num > 0)
{?>
    <div class="field padding-bottom--24">
    <label><b>Name The Topic is : </b></label><br>
    <label><?php echo $row['Ch_Topic'];?></label><br>
    <label> <b> Name The SubTopics is : </b></label><br>
    <label><?php $q = mysqli_query($conn,"SELECT Ch_SupTopic, Ch_ID from chapter where Ch_Number = '$chapter' and Su_ID = '$id'");?>
    <select class="form-control" onchange="row()" name="subtopic" id="subT" required>
    <option value="0">select the subTopic :</option>
    <?php
    while ($r = mysqli_fetch_assoc($q)) { ?>        
    <option id="subbt"  value='<?php echo $r['Ch_SupTopic']?>'><?php echo $r['Ch_SupTopic']?></option>
    <?php }?>
    </select>
</div>
<script>
function row(){
    var top = document.getElementById('subT').value;
    var x = document.getElementById('x').value;
    var id = window.location.search;
    const urlPar = new URLSearchParams(id);
    const Cid = urlPar.get('id');

    // alert(x);
    $("#title").empty();
   if (top !=' ' )
    {
      
      $.get("getSubval.php?data=title&chapterid="+x+"&id="+Cid+"&value="+top, function(data, status)
      {
        //alert("Data: " + fact + "\nStatus: " + status); 
       //alert(top);
       $("#sub").empty(); 
          $('#sub').append(data);
      });
    }
    else
    return false;
  }
</script>
<?php } 
else{ echo "you don't have any topics and subtopics"; }?>
