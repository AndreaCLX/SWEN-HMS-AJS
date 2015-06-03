<?php
$database = mysqli_connect('localhost','root','','hms');
$RoomIDErr = $StaffIDErr = $DutyTypeErr = $ScheduleErr= "";
$RoomID = $StaffID = $DutyType = $Schedule= "";

function test_input($a){
    return $a;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $RoomID = @$_POST['RoomID'];
    $StaffID = @$_POST['StaffID'];
    $DutyType = @$_POST['DutyType'];
    $Schedule = @$_POST['Schedule'];

    //$query= "INSERT INTO `staff`(`username`,`password`,`email`,`PhoneNumber`,`BankAccount`,`Address`,`PostalCode`,`Birthday`) VALUES ('$username',`$password`,`$email`,`PhoneNumber`,`BankAccount`,`Address`,`PostalCode`,`Birthday`)";


    $query = "INSERT INTO `duty` (`RoomID`,`StaffID`,`DutyType`,`Schedule`) VALUES ('$RoomID','$StaffID','$DutyType','$Schedule')";
    if(mysqli_query($database,$query)){
        echo "Success! <br/>YAZZZZ";
    } else{
        echo mysqli_error($database)+"<br /><br />";
        echo $query;
    }

    $query = "";

}
?>
<!DOCTYPE html>
<html>
<head>
</head>
<body>
<p><span class="error">* required field.</span></p><form method="POST">
    RoomID: <input type="text" name="RoomID" value="<?php echo $RoomID;?>" /> <span class="error">* <?php echo $RoomIDErr;?></span> <br /><br />
    StaffID: <input type="text" name="StaffID" value="<?php echo $StaffID;?>" /> <span class="error">* <?php echo $StaffIDErr;?></span> <br /><br />
    DutyType: <input type="text" name="DutyType" value="<?php echo $DutyType;?>">
    <span class="error">* <?php echo $DutyTypeErr;?></span>
    <br><br>
    Schedule: <input type="text" name="Schedule" value="<?php echo $Schedule;?>"/> <span class="error">* <?php echo $ScheduleErr;?></span> <br /><br />
    <input type="submit" name="submit" value="Submit!"/>
</form>
<?php
echo "<h2>Your Input:</h2>";
echo $RoomID;
echo "<br>";
echo $StaffID;
echo "<br>";
echo $DutyType;
echo "<br>";
echo $Schedule;
echo "<br>";
?>
</body>
</html>


<?php

?>
