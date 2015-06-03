<?php
$database = mysqli_connect('localhost','root','','hms');

$guestid = @$_GET['GuestID'];

$query = "DELETE FROM `guest` WHERE `GuestID` = '$guestid'";
if(mysqli_query($database,$query)){
    echo "Success! <br />Please Wait";
}else {
    echo mysqli_error($database) + "<br /><br />";
    echo $query;
}
?>
<td><a href="indexGuestRetrieve.php?GuestID=<?php echo $a['Guest'] ?>">Back</a></td>

