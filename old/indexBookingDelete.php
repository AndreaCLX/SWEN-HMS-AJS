<?php
$database = mysqli_connect('localhost','root','','hms');

$bookingid = @$_GET['BookingID'];

$query = "DELETE FROM `booking` WHERE `BookingID` = '$bookingid'";
if(mysqli_query($database,$query)){
    echo "Success! <br />Please Wait";
}else {
    echo mysqli_error($database) + "<br /><br />";
    echo $query;
}
?>
<td><a href="indexbookingretrieve.php?BookingID=<?php echo $a['Booking'] ?>">Back</a></td>