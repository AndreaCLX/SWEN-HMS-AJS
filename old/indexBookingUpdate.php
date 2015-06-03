<?php
$database = mysqli_connect('localhost','root','','hms');

$bookingid = @$_GET['BookingID'];

if($_POST){
    $roomid = @$_POST['RoomID'];
    $additionalguests = @$_POST['AdditionalGuests'];
    $paymentmethod = @$_POST['PaymentMethod'];
    $paymentadditionalinfo = @$_POST['PaymentAdditionalInfo'];
    $checkindate = @$_POST['CheckInDate'];
    $checkoutdate = @$_POST['CheckOutDate'];
    $checkouttime = @$_POST['CheckOutTime'];

    $query = "UPDATE `booking` SET `RoomID` = '$roomid', `AdditionalGuests` = '$additionalguests', `PaymentMethod` = '$paymentmethod', `PaymentAdditionalInfo` = '$paymentadditionalinfo', `CheckInDate` = '$checkindate', `CheckOutDate` = '$checkoutdate', `CheckOutTime` = '$checkouttime' WHERE `BookingID` = '$bookingid'";

    if(mysqli_query($database,$query)){
        echo "Success! <br />Please Wait";
    }else {
        echo mysqli_error($database) + "<br /><br />";
        echo $query;
    }
}

$ret = "SELECT * FROM `booking` WHERE `BookingID` = '$bookingid'";

$booking = mysqli_fetch_assoc(mysqli_query($database,$ret));



?>
<!DOCTYPE html>
<html>
<head>

</head>
<body>


<br />

<form action="?BookingID=<?php echo $bookingid; ?>" method="post">

    RoomID: <input type="text" name="RoomID" value="<?php echo $booking['RoomID']; ?>"/> <br />
    AdditionalGuests: <input type="text" name="AdditionalGuests"value="<?php echo $booking['AdditionalGuests']; ?>" /> <br />
    PaymentMethod: <input type="text" name="PaymentMethod" value="<?php echo $booking['PaymentMethod']; ?>" /> <br />
    PaymentAdditionalInfo: <input type="text" name="PaymentAdditionalInfo" value="<?php echo $booking['PaymentAdditionalInfo']; ?>"/> <br />
    CheckInDate: <input type="text" name="CheckInDate" value="<?php echo $booking['CheckInDate']; ?>"/> <br />
    CheckOutDate: <input type="text" name="CheckOutDate"value="<?php echo $booking['CheckOutDate']; ?>" /> <br />
    CheckOutTime: <input type="text" name="CheckOutTime"value="<?php echo $booking['CheckOutTime']; ?>" /> <br />
    <td><a href="indexbookingretrieve.php?BookingID=<?php echo $a['Booking'] ?>">Back</a></td>
    <input type="submit" />
</form>
</body>
</html>