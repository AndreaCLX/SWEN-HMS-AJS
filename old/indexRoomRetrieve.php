<?php
$database = mysqli_connect('localhost','root','','hms');
?>
<div class="scrolling-container">
    <table class="table special-colored-table">
        <thead>
        <tr>
            <td>RoomID</td>
            <td>Type</td>
            <td>Location</td>
            <td>Status</td>
            <td>Rate</td>
            <td></td>
        </tr>
        </thead>
        <tbody>
        <?php
        $query = mysqli_query($database,"SELECT * FROM `room` ORDER BY `RoomID` DESC");
        while($a = mysqli_fetch_assoc($query)){
            ?>
            <tr>
                <td><?php echo $a['RoomID']; ?></td>
                <td><?php echo $a['Type']; ?></td>
                <td><?php echo $a['Location']; ?></td>
                <td><?php echo $a['Status']; ?></td>
                <td><?php echo $a['Rate']; ?></td>
                <td><a href="indexRoomUpdate.php?RoomID=<?php echo $a['RoomID'] ?>">Edit</a></td>
                <td><a href="indexRoomDelete.php?RoomID=<?php echo $a['RoomID'] ?>">Delete</a></td>
            </tr>
        <?php
        }
        ?>
        </tbody>
    </table>
</div>