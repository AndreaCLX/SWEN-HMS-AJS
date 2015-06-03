<?php
$database = mysqli_connect('localhost','root','','hms');
$staffid = @$_GET['StaffID'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = @$_POST['Username'];
    $password = @$_POST['Password'];
    $email = @$_POST['Email'];
    $PhoneNumber = @$_POST['PhoneNumber'];
    $BankAccount = @$_POST['BankAccount'];
    $Address = @$_POST['Address'];
    $PostalCode = @$_POST['PostalCode'];
    $Birthday = @$_POST['Birthday'];

    $query = "UPDATE `staff` SET `Username` = '$username', `Password` = '$password',`Email` = '$email',`PhoneNumber`='$PhoneNumber',`BankAccount`='$BankAccount',`Address`='$Address',`PostalCode`='$PostalCode',`Birthday`='$Birthday' WHERE `StaffID` = '$staffid'";
    if(mysqli_query($database,$query)){
        echo "Success!YAZZZZZ <br />Please Wait";
    }else {
        echo mysqli_error($database) + "<br /><br />";
        echo $query;
    }
}
$ret = "SELECT * FROM `staff` WHERE `StaffID` = '$staffid'";
$staff = mysqli_fetch_assoc(mysqli_query($database,$ret));
?>

<!DOCTYPE html>
<html>
<head>
</head>
<body>
<br />
<form action="?StaffID=<?php echo $staffid; ?>" method="post">
    Username: <input type="text" name="Username" value="<?php echo $staff['Username']; ?>"/> <br />
    Password: <input type="text" name="Password" value="<?php echo $staff['Password'];?>"/> <br/>
    Email: <input type="text" name="Email" value="<?php echo $staff['Email']; ?>"/> <br />
    PhoneNumber: <input type="text" name="PhoneNumber"value="<?php echo $staff['PhoneNumber']; ?>" /> <br />
    BankAccount: <input type="text" name="BankAccount" value="<?php echo $staff['BankAccount']; ?>" /> <br />
    Address: <input type="text" name="Address" value="<?php echo $staff['Address']; ?>" /> <br />
    PostalCode: <input type="text" name="PostalCode" value="<?php echo $staff['PostalCode']; ?>"/> <br />
    Birthday: <input type="text" name="Birthday" value="<?php echo $staff['Birthday']; ?>"/> <br />
    <td><a href="StaffRetrieve.php?>StaffID=<?php echo $a['Staff'] ?>" >Back</a></td>
    <input type="submit" />
</form>
</body>
</html>
