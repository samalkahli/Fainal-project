<?php
include_once('../includes/conn.php');
$que = $_GET['que'];
$query = "SELECT * from question where Qu_ID = '$que'";
$res = mysqli_query($conn,$query);
$row = mysqli_fetch_assoc($res);
if ($row['Qu_Type'] == "True Or False")
{ ?>
    <div class="field padding-bottom--24">
        <label for="name">Type Of Question </label><br>
        <label for="name"><?php echo $row['Qu_Type'];?> </label>
    </div>
    <div class="field padding-bottom--24">
        <label for="name">Mark Of Question </label><br>
        <label for="name"><?php echo $row['Qu_Mark'];?> </label>
    </div>
    <div class="field padding-bottom--24">
        <label for="name"> Answer Of Question </label><br>
        <label for="name"><?php echo $row['Qu_Answer'];?> </label>
    </div>

<?php }
if ($row['Qu_Type'] == 'Choices')
{?>
    <div class="field padding-bottom--24">
        <label for="name">Type Of Question </label><br>
        <label for="name"><?php echo $row['Qu_Type'];?> </label>
    </div>
    <div class="field padding-bottom--24">
        <label for="name">Mark Of Question </label><br>
        <label for="name"><?php echo $row['Qu_Mark'];?> </label>
    </div>
    <div class="field padding-bottom--24">
        <table class="table">
        <thead>
        <tr>
            <th>Choice A </th>
            <th>Choice B </th>
            <th>Choice C </th>
            <th>Choice D </th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td><?php echo $row['Qu_A'];?></td>
            <td><?php echo $row['Qu_B'];?></td>
            <td><?php echo $row['Qu_C'];?></td>
            <td><?php echo $row['Qu_D'];?></td>
        </tr>
    </tbody>
    </table>
    </div>
    <div class="field padding-bottom--24">
        <label for="name"> Answer Of Question </label><br>
        <label for="name"><?php echo $row['Qu_Answer'];?> </label>
    </div>
    
<?php }
if ($row['Qu_Type'] == 'Direct')
{?>
    <div class="field padding-bottom--24">
        <label for="name">Type Of Question </label><br>
        <label for="name"><?php echo $row['Qu_Type'];?> </label>
    </div>
    <div class="field padding-bottom--24">
        <label for="name">Mark Of Question </label><br>
        <label for="name"><?php echo $row['Qu_Mark'];?> </label>
    </div>
    <div class="field padding-bottom--24">
        <label for="name"> Answer Of Question </label><br>
        <label for="name"><?php echo $row['Qu_Answer'];?> </label>
    </div>
<?php }?>