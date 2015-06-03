<?php
$database = mysqli_connect('localhost','root','','hms');
$dutyid = @$_GET['DutyID'];
$query = "DELETE FROM `duty` WHERE `DutyID` = '$dutyid'";
if(mysqli_query($database,$query)){
    echo "Success! <br />Please Wait";
}else {
    echo mysqli_error($database) + "<br /><br />";
    echo $query;
}
?>
<td><a href="DutyRetrieve.php?<?php echo $a['Duty'] ?>">Back</a></td>