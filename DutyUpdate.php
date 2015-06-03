<?php
$database = mysqli_connect('localhost','root','','hms');
$dutyid = @$_GET['DutyID'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $RoomID = @$_POST['RoomID'];
    $StaffID = @$_POST['StaffID'];
    $DutyType = @$_POST['DutyType'];
    $Schedule = @$_POST['Schedule'];

    $query = "UPDATE `duty` SET `RoomID` = '$RoomID', `StaffID` = '$StaffID',`DutyType` = '$DutyType',`Schedule`='$Schedule' WHERE `DutyID` = '$dutyid'";
    if(mysqli_query($database,$query)){
        echo "Success!YAZZZZZ <br />Please Wait";
    }else {
        echo mysqli_error($database) + "<br /><br />";
        echo $query;
    }
}
$ret = "SELECT * FROM `duty` WHERE `DutyID` = '$dutyid'";
$duty = mysqli_fetch_assoc(mysqli_query($database,$ret));
?>

<!DOCTYPE html>
<html>
<head>
</head>
<body>
<br />
<form action="?StaffID=<?php echo $dutyid; ?>" method="post">
    RoomID: <input type="text" name="RoomID" value="<?php echo $duty['RoomID']; ?>"/> <br />
    StaffID: <input type="text" name="StaffID" value="<?php echo $duty['StaffID'];?>"/> <br/>
    DutyType: <input type="text" name="DutyType" value="<?php echo $duty['DutyType']; ?>"/> <br />
    Schedule: <input type="text" name="Schedule"value="<?php echo $duty['Schedule']; ?>" /> <br />
    <td><a href="DutyRetrieve.php?>StaffID=<?php echo $a['Staff'] ?>" >Back</a></td>
    <input type="submit" />
</form>
</body>
</html>
