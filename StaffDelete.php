<?php
$database = mysqli_connect('localhost','root','','hms');
$staffid = @$_GET['StaffID'];
$query = "DELETE FROM `staff` WHERE `StaffID` = '$staffid'";
if(mysqli_query($database,$query)){
    echo "Success! <br />Please Wait";
}else {
    echo mysqli_error($database) + "<br /><br />";
    echo $query;
}
?>
<td><a href="StaffRetrieve.php?<?php echo $a['Duty'] ?>">Back</a></td>