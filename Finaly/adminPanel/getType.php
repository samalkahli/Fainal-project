<?php
$type = $_GET['type'];
if ($type == "True Or False")
{ ?>
    <div class="field padding-bottom--24">
        <label for="name">The Question :</label>
        <input type="text" name="question">
    </div>
    <div class=" padding-bottom--24">
        <label for="name">The Answer :</label> <br>
        <input type="radio" value="True" name="answer">True <br>
        <input type="radio" value="False" name="answer">False 
    </div>
<?php }
if ($type == 'Choices')
{?>
    <div class="field padding-bottom--24">
        <label for="name">The Question :</label>
        <input type="text" name="question">
    </div>
    <div class="field padding-bottom--24">
        <label for="name">Option A :</label>
        <input type="text" name="a">
    </div>
    <div class="field padding-bottom--24">
        <label for="name">Option B :</label>
        <input type="text" name="b">
    </div>
    <div class="field padding-bottom--24">
        <label for="name">Option C :</label>
        <input type="text" name="c">
    </div>
    <div class="field padding-bottom--24">
        <label for="name">Option D :</label>
        <input type="text" name="d">
    </div>
    <div class="field padding-bottom--24">
        <label for="name">Answer :</label>
        <input type="text" name="answer">
    </div>
    
<?php }
if ($type == 'Direct')
{?>
    <div class="field padding-bottom--24">
        <label for="name">The Question :</label>
        <input type="text" name="question">
    </div>
    <div class="field padding-bottom--24">
        <label for="name">The answer :</label>
        <input type="text" name="answer">
    </div>
<?php }?>