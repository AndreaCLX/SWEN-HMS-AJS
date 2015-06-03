<?php
$database = mysqli_connect('localhost','root','','hms');
$GuestID = @$_POST['GuestID'];
$RoomID = @$_POST['RoomID'];
$AdditionalGuest = @$_POST['AdditionalGuest'];
$PaymentMethod = @$_POST['PaymentMethod'];
$PaymentAdditionalInfo = @$_POST['PaymentAdditionalInfo'];
$CheckInDate = @$_POST['CheckInDate'];
$CheckOutDate = @$_POST['CheckOutDate'];
$CheckOutTime = @$_POST['CheckOutTime'];

if($_POST){

 $query = "INSERT INTO `booking` (`GuestID` , `RoomID` ,`AdditionalGuests` , `PaymentMethod`, `PaymentAdditionalInfo` , `CheckInDate` ,  `CheckOutDate` , `CheckOutTime`) VALUES ('$GuestID' , '$RoomID' , '$AdditionalGuest' , '$PaymentMethod' , '$PaymentAdditionalInfo' , '$CheckInDate' , '$CheckOutDate' , 'CheckOutTime')";
    if(mysqli_query($database,$query)){
        echo "Success! <br />Please Wait";
    }else {
        echo mysqli_error($database) + "<br /><br />";
        echo $query;
    }
}

?>
<!DOCTYPE html>
<html>
<head>

</head>
<body>


<br />

<form method="post">

    GuestID:
    <select name="GuestID">
        <?php
        $query = mysqli_query($database,"SELECT * FROM `guest` ORDER BY `GuestID` DESC");
        while($a = mysqli_fetch_assoc($query)){
            ?>
            <option value="<?php echo $a['GuestID']; ?>"><?php echo $a['Name']; ?> (<?php echo $a['Email']; ?>)</option>

        <?php
        }
        ?>
    </select><br />
    RoomID: <input type="text" name="RoomID" /> <br />
    AdditionalGuest: <input type="text" name="AdditionalGuest" /> <br />
    PaymentMethod: <input type="text" name="PaymentMethod" /> <br />
    PaymentAdditionalInfo: <input type="text" name="PaymentAdditionalInfo" /> <br />
    CheckInDate: <input type="text" name="CheckInDate" /> <br />
    CheckOutDate: <input type="text" name="CheckOutDate" /> <br />
    CheckOutTime: <input type="text" name="CheckOutTime" /> <br />

    <input type="submit" />
</form>
</body>
</html>