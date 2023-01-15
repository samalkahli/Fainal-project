<?php
include_once('../includes/conn.php');
$chapter = $_GET['chapterid'];
$id = $_GET['id'];
$query = mysqli_query($conn, "SELECT * from chapter where Ch_Number = '$chapter'and Su_ID = '$id'");
$row = mysqli_fetch_assoc($query); 

$num = mysqli_num_rows($query);

if ($num > 0)
{?>
    <div class=" padding-bottom--24">
    <label><b>Name The Topic is : </b></label><br>
    <label><?php echo $row['Ch_Topic'];?></label><br>
    <input type="text" name="chapterCilos" value="<?php echo $row['Ch_ID'];?> " readonly style="display: none;">
    <label> <b> Select The Cilos To Chapter : </b></label><br>

    <?php
    $d = "SELECT * from cilo where Su_ID = '$id'";
     $q = mysqli_query($conn,$d);


        $qC = mysqli_query($conn,

        "SELECT chp_cilo.*, cilo.*, chapter.*, subject.*
        from chp_cilo
        left join cilo on cilo.C_ID = chp_cilo.C_ID
        left join chapter on chapter.Ch_ID = chp_cilo.Ch_ID 
        left join subject on subject.Su_ID = chapter.Su_ID
        where  chapter.Ch_Number = $chapter
        ");
        if ($num = mysqli_num_rows($qC) > 0)
        { 
        while ($r = mysqli_fetch_assoc($qC))
        {?>
            <input type="text" name="alias[]" value="<?php echo $r['ChC_ID']; ?>" style="display: none;">
            <label for=""><?php echo $r['C_Alias']; ?></label><br>
          
       <?php }
        
        ?>
        <div class="filed padding-top--24 padding-bottom--24">
        <input class="btn btn-danger" onClick="return confirm('Are you sure you want to delete?')" name="del" type="submit" value="Delete">
        </div>
        <a data-bs-toggle="collapse" href="#divvv" aria-expanded="false" aria-controls="ui-basic">
            <button class=" btn btn-primary ">Add Question</button>
        </a>
        <div  class="collapse" id="divvv" style="margin: 20px;">
                        <div class="field padding-bottom--24">
                            <label for="name">Import the question from Excel File</label>
                            <input class="form-control" type="file" accept=".xls,.xlsx" name="fileToUpload" id="fileToUpload">
                            <span>if you want xlsx sheet<a href="download/question/AddQuestion.xlsx"> click here!</a></span>
                        </div>
                        <button class="btn btn-primary" name="Que" type="submit">add</button>
                        <a data-bs-toggle="collapse" href="#divv" aria-expanded="false" aria-controls="ui-basic">
                            <button class="menu-title btn btn-primary ">Add Manually</button>
                        </a>
                    
                        <div class="collapse" id="divv" style="margin: 20px;">

                            <div class="field padding-bottom--24">
                                <label>Type Of Question</label>
                                <select class="form-control" id="type" name="typeq" onchange="getType()">
                                    <option value="">Select Type :</option>
                                    <option value="True Or False">True Or False</option>
                                    <option value="Choices">Choices</option>
                                    <option value="Direct">Direct</option>
                                </select>
                            </div>
                            <div id="dropT">

                            </div>
                            <div class="field padding-bottom--24">
                                <input class="btn btn-primary" type="submit" name="new" value="Add Q">
                            </div>
                        </div>
                    </div>
                
          
       <?php }
        else {
    
     while ($r = mysqli_fetch_assoc($q)) {?>
     
    <input class="checkbox" id="cilos" name="cilos[]" title="<?php echo $r['C_Text'];?>" type="checkbox" value="<?php echo $r['C_ID'];?>"> <?php echo $r['C_Alias'];?><br>
    
    <?php  }?>

    </div>
    <input type="submit" class="btn btn-primary" value="Make Relationship" name="make">

<?php } }  
else{ echo "you don't have any topics and subtopics"; }?>
