<?php
$database = mysqli_connect('localhost','root','','hms');

$roomid = @$_GET['RoomID'];

if($_POST){
    $type = @$_POST['Type'];
    $location = @$_POST['Location'];
    $status = @$_POST['Status'];
    $rate = @$_POST['Rate'];

    $query = "UPDATE `room` SET `Type` = '$type', `Location` = '$location', `Status` = '$status', `Rate` = '$rate' WHERE `RoomID` = '$roomid'";

    if(mysqli_query($database,$query)){
        echo "Success! <br />Please Wait";
    }else {
        echo mysqli_error($database) + "<br /><br />";
        echo $query;
    }
}

$ret = "SELECT * FROM `room` WHERE `RoomID` = '$roomid'";

$room = mysqli_fetch_assoc(mysqli_query($database,$ret));



?>
<!DOCTYPE html>
<html>
<head>

</head>
<body>


<br />

<form action="?RoomID=<?php echo $roomid; ?>" method="post">

    Type: <input type="text" name="Type" value="<?php echo $room['RoomID']; ?>"/> <br />
    Location: <input type="text" name="Location"value="<?php echo $room['Location']; ?>" /> <br />
    Status: <input type="text" name="Status" value="<?php echo $room['Status']; ?>" /> <br />
    Rate: <input type="text" name="Rate" value="<?php echo $room['Rate']; ?>"/> <br />
    <td><a href="indexRoomRetrieve.php?RoomID=<?php echo $a['Room'] ?>">Back</a></td>
    <input type="submit" />
</form>
</body>
</html>