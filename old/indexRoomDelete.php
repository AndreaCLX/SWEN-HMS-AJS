<?php
$database = mysqli_connect('localhost','root','','hms');

$roomid = @$_GET['RoomID'];

$query = "DELETE FROM `room` WHERE `RoomID` = '$roomid'";
if(mysqli_query($database,$query)){
    echo "Success! <br />Please Wait";
}else {
    echo mysqli_error($database) + "<br /><br />";
    echo $query;
}
?>
<td><a href="indexRoomRetrieve.php?RoomID=<?php echo $a['Room'] ?>">Back</a></td>

