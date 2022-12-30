<?php
include('../includes/conn.php');
$chapter = $_GET['chapterid'];
$title = $_GET['value'];
$id = $_GET['id'];
$qe = mysqli_query($conn,"SELECT Ch_SupTopic, Ch_ID from chapter where Ch_SupTopic = '$title'");
$row = mysqli_fetch_assoc($qe);
?>

