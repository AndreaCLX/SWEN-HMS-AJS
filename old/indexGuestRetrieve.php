<?php
$database = mysqli_connect('localhost','root','','hms');
?>
<div class="scrolling-container">
    <table class="table special-colored-table">
        <thead>
        <tr>
            <td>GuestID</td>
            <td>Name</td>
            <td>Email</td>
            <td>ContactNumber</td>
            <td>Address</td>
            <td>PostalCode</td>
            <td>Record</td>
            <td>Country</td>
            <td></td>
        </tr>
        </thead>
        <tbody>
        <?php
        $query = mysqli_query($database,"SELECT * FROM `guest` ORDER BY `GuestID` DESC");
        while($a = mysqli_fetch_assoc($query)){
            ?>
            <tr>
                <td><?php echo $a['GuestID']; ?></td>
                <td><?php echo $a['Name']; ?></td>
                <td><?php echo $a['Email']; ?></td>
                <td><?php echo $a['ContactNumber']; ?></td>
                <td><?php echo $a['Address']; ?></td>
                <td><?php echo $a['PostalCode']; ?></td>
                <td><?php echo $a['Record']; ?></td>
                <td><?php echo $a['Country']; ?></td>
                <td><a href="indexGuestupdate.php?GuestID=<?php echo $a['GuestID'] ?>">Edit</a></td>
                <td><a href="indexGuestDelete.php?GuestID=<?php echo $a['GuestID'] ?>">Delete</a></td>
            </tr>
        <?php
        }
        ?>
        </tbody>
    </table>
</div>