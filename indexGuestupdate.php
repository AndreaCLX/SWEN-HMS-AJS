<?php
$database = mysqli_connect('localhost','root','','hms');

$guestid = @$_GET['GuestID'];

if($_POST){
    $name = @$_POST['Name'];
    $email = @$_POST['Email'];
    $contactnumber = @$_POST['ContactNumber'];
    $address = @$_POST['Address'];
    $postalcode = @$_POST['PostalCode'];
    $record = @$_POST['Record'];
    $country = @$_POST['Country'];

    $query = "UPDATE `guest` SET `Name` = '$name', `Email` = '$email', `ContactNumber` = '$contactnumber', `Address` = '$address', `PostalCode` = '$postalcode', `Record` = '$record', `Country` = '$country' WHERE `GuestID` = '$guestid'";

    if(mysqli_query($database,$query)){
        echo "Success! <br />Please Wait";
    }else {
        echo mysqli_error($database) + "<br /><br />";
        echo $query;
    }
}

$ret = "SELECT * FROM `guest` WHERE `GuestID` = '$guestid'";

$guest = mysqli_fetch_assoc(mysqli_query($database,$ret));



?>
<!DOCTYPE html>
<html>
<head>

</head>
<body>


<br />

<form action="?GuestID=<?php echo $guestid; ?>" method="post">


    Name: <input type="text" name="Name" value="<?php echo $guest['Name']; ?>"/> <br />
    Email: <input type="text" name="Email" value="<?php echo $guest['Email']; ?>"/> <br />
    ContactNumber: <input type="text" name="ContactNumber"value="<?php echo $guest['ContactNumber']; ?>" /> <br />
    Address: <input type="text" name="Address" value="<?php echo $guest['Address']; ?>" /> <br />
    PostalCode: <input type="text" name="PostalCode" value="<?php echo $guest['PostalCode']; ?>"/> <br />
    Record: <input type="text" name="Record" value="<?php echo $guest['Record']; ?>"/> <br />
    Country: <input type="text" name="Country"value="<?php echo $guest['Country']; ?>" /> <br />
    <td><a href="indexGuestRetrieve.php?GuestID=<?php echo $a['Guest'] ?>">Back</a></td>
    <input type="submit" />
</form>
</body>
</html>