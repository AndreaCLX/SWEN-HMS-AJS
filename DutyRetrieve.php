<?php
$database = mysqli_connect('localhost','root','','hms');
?>

<div class="scrolling-container">
    <table class="table special-colored-table">
        <thead>
        <tr>
            <td>RoomID</td>
            <td>StaffID</td>
            <td>DutyType</td>
            <td>Schedule</td>
            <td></td>
        </tr>
        </thead>
        <tbody>
        <?php
        $query = mysqli_query($database,"SELECT * FROM `duty` ORDER BY `DutyID` DESC");
        while($a = mysqli_fetch_assoc($query)){
            ?>
            <tr>
                <td><?php
                    $rid = $a['RoomID'];
                    $query2 = mysqli_query($database,"SELECT * FROM `room` WHERE `RoomID` = '$rid'");
                    $r = mysqli_fetch_assoc($query2);
                    echo $r['Type'].'('.$r['RoomID'].')';
                    ?></td>
                <td><?php
                    $sid = $a['StaffID'];
                    $query3 = mysqli_query($database,"SELECT * FROM `staff` WHERE `StaffID` = '$sid'");
                    $s = mysqli_fetch_assoc($query3);
                    echo $s['Username'] . '(' .$s['StaffID'].')';
                    ?></td>
                <td><?php echo $a['DutyType']; ?></td>
                <td><?php echo $a['Schedule']; ?></td>
                <td><a href="DutyUpdate.php?DutyID=<?php echo $a['DutyID'] ?>">Edit</a></td>
                <td><a href="DutyDelete.php?DutyID=<?php echo $a['DutyID'] ?>">Delete</a></td>
            </tr>
        <?php
        }
        ?>
        </tbody>
    </table>
</div>
