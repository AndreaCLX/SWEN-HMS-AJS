<?php
$database = mysqli_connect('localhost','root','','hms');
?>
<div class="scrolling-container">
    <table class="table special-colored-table">
        <thead>
        <tr>
            <td>BookingID</td>
            <td>GuestID</td>
            <td>RoomID</td>
            <td>AdditionalGuests</td>
            <td>PaymentMethod</td>
            <td>PaymentAdditionalInfo</td>
            <td>CheckInDate</td>
            <td>CheckOutDate</td>
            <td>CheckOutTime</td>
            <td></td>
        </tr>
        </thead>
        <tbody>
        <?php
        $query = mysqli_query($database,"SELECT * FROM `booking` ORDER BY `BookingID` DESC");
        while($a = mysqli_fetch_assoc($query)){
            ?>
            <tr>
                <td><?php echo $a['BookingID']; ?></td>
                <td>
                    <?php
                    $gid = $a['GuestID'];
                    $query2 = mysqli_query($database,"SELECT * FROM `guest` WHERE `GuestID` = '$gid'");
                    $guestInfo = mysqli_fetch_assoc($query2);
                    echo $guestInfo['Name'].'('.$guestInfo['Email'].')';
                    ?>
                </td>
                <td><?php echo $a['RoomID']; ?></td>
                <td><?php echo $a['AdditionalGuests']; ?></td>
                <td><?php echo $a['PaymentMethod']; ?></td>
                <td><?php echo $a['PaymentAdditionalInfo']; ?></td>
                <td><?php echo $a['CheckInDate']; ?></td>
                <td><?php echo $a['CheckOutDate']; ?></td>
                <td><?php echo $a['CheckOutTime']; ?></td>
                <td><a href="indexBookingUpdate.php?BookingID=<?php echo $a['BookingID'] ?>">Edit</a></td>
                <td><a href="indexBookingDelete.php?BookingID=<?php echo $a['BookingID'] ?>">Delete</a></td>
            </tr>
        <?php
        }
        ?>
        </tbody>
    </table>
</div>
