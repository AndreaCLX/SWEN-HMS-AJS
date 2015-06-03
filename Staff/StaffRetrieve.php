<?php
$database = mysqli_connect('localhost','root','','hms');
?>
<div class="scrolling-container">
    <table class="table special-colored-table">
        <thead>
        <tr>
            <td>StaffID</td>
            <td>Username</td>
            <td>Password</td>
            <td>Email</td>
            <td>PhoneNumber</td>
            <td>BankAccount</td>
            <td>Address</td>
            <td>PostalCode</td>
            <td>Birthday</td>
            <td></td>
        </tr>
        </thead>
        <tbody>
        <?php
        $query = mysqli_query($database,"SELECT * FROM `staff` ORDER BY `StaffID` DESC");
        while($a = mysqli_fetch_assoc($query)){
            ?>
            <tr>
                <td><?php echo $a['StaffID']; ?></td>
                <td><?php echo $a['Username']; ?></td>
                <td><?php echo $a['Password']; ?></td>
                <td><?php echo $a['Email']; ?></td>
                <td><?php echo $a['PhoneNumber']; ?></td>
                <td><?php echo $a['BankAccount']; ?></td>
                <td><?php echo $a['Address']; ?></td>
                <td><?php echo $a['PostalCode']; ?></td>
                <td><?php echo $a['Birthday']; ?></td>
                <td><a href="StaffUpdate.php?StaffID=<?php echo $a['StaffID'] ?>">Edit</a></td>
                <td><a href="StaffDelete.php?StaffID=<?php echo $a['StaffID'] ?>">Delete</a></td>
            </tr>
        <?php
        }
        ?>
        </tbody>
    </table>
</div>
