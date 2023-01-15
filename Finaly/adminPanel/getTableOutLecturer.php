<?php
    include_once("../includes/conn.php");
    $query= "  SELECT subject.*, program.P_Name, department.* 
    FROM subject
    LEFT JOIN program ON subject.P_ID = program.P_ID
    LEFT JOIN department ON program.D_ID = department.D_ID 
    where subject.status = 'noactive'
    ";
    $result = mysqli_query($conn,$query);
    $i = 1;
    while ($row = mysqli_fetch_assoc($result)) {
        //var_dump($row);
    ?>
        <tr>
        <td><?php echo $i; $i++ ?></td>
        <td><?php echo $row['D_Name']; ?></td>
        <td><?php echo $row['P_Name']; ?></td>
        <td><?php echo $row['Su_Name']; ?></td>
        <td><?php echo $row['semster']; ?></td>
        <td><?php echo $row['Su_Chapter']; ?></td>
        <!-- <td><?php #echo $row['Le_Name']; ?></td> -->
        <td>
            <a href="edit-subject.php?id=<?php echo $row['Su_ID']; ?>&Did=<?php echo $row['D_ID']; ?>">
            <button class="btn btn-primary"><i class="fa fa-edit "></i> Edit</button> </a>

            <a href="add-lecturer-subject.php?id=<?php echo $row['Su_ID']; ?>">
            <button class="btn btn-outline-dark"><i class="fa fa-edit "></i> Lecturer</button> </a>

            <a href="add-chapter.php?id=<?php echo $row['Su_ID']; ?>">
            <button class="btn btn-outline-success"><i class="fa fa-edit "></i> Chapter</button> </a>

            <a href="add-cilo.php?id=<?php echo $row['Su_ID']; ?>">
            <button class="btn btn-outline-dark btn-"><i class="fa fa-edit "></i>CILOs</button> </a>

            <a href="manage-subject.php?id=<?php echo $row['Su_ID']; ?>&del=delete" onClick="return confirm('Are you sure you want to delete?')">
            <button class="btn btn-danger">Delete</button>
            </a>
        </td>

        </tr>
        <?php } ?>