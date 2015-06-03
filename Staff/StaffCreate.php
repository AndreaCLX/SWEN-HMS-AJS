<?php
$database = mysqli_connect('localhost','root','','hms');
$usernameErr = $passwordErr = $emailErr = $PhoneNumberErr = $BankAccountErr = $AddressErr = $PostalCodeErr = $BirthdayErr = "";
$username = $password = $email = $PhoneNumber = $BankAccount = $Address = $PostalCode = $Birthday = "";

function test_input($a){
    return $a;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = @$_POST['Username'];
    $password = @$_POST['Password'];
    $email = @$_POST['Email'];
    $PhoneNumber = @$_POST['PhoneNumber'];
    $BankAccount = @$_POST['BankAccount'];
    $Address = @$_POST['Address'];
    $PostalCode = @$_POST['PostalCode'];
    $Birthday = @$_POST['Birthday'];

    //$query= "INSERT INTO `staff`(`username`,`password`,`email`,`PhoneNumber`,`BankAccount`,`Address`,`PostalCode`,`Birthday`) VALUES ('$username',`$password`,`$email`,`PhoneNumber`,`BankAccount`,`Address`,`PostalCode`,`Birthday`)";


    $query = "INSERT INTO `staff` (`Username`,`Password`,`Email`,`PhoneNumber`,`BankAccount`,`Address`,`PostalCode`,`Birthday`) VALUES ('$username','$password','$email','$PhoneNumber','$BankAccount','$Address','$PostalCode','$Birthday')";
    if(mysqli_query($database,$query)){
        echo "Success! <br/>YAZZZZ";
    } else{
        echo mysqli_error($database)+"<br /><br />";
        //echo $query;
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
        Username: <input type="text" name="Username" value="<?php echo $username;?>" /> <span class="error">* <?php echo $usernameErr;?></span> <br /><br />
        Password: <input type="text" name="Password" value="<?php echo $password;?>" /> <span class="error">* <?php echo $passwordErr;?></span> <br /><br />
        E-mail: <input type="text" name="Email" value="<?php echo $email;?>">
        <span class="error">* <?php echo $emailErr;?></span>
        <br><br>
        PhoneNumber: <input type="text" name="PhoneNumber" value="<?php echo $PhoneNumber;?>"/> <span class="error">* <?php echo $PhoneNumberErr;?></span> <br /><br />
        BankAccount: <input type="text" name="BankAccount" value="<?php echo $BankAccount;?>"/> <span class="error">* <?php echo $BankAccountErr;?></span><br /><br />
        Address: <input type="text" name="Address" value="<?php echo $Address;?>"/> <span class="error">* <?php echo $AddressErr;?></span><br /><br />
        PostalCode: <input type="text" name="PostalCode" value="<?php echo $PostalCode;?>"/> <span class="error">* <?php echo $PostalCodeErr;?></span><br /><br />
        Birthday: <input type="text" name="Birthday" value="<?php echo $Birthday;?>"/> <span class="error">* <?php echo $BirthdayErr;?></span><br /><br />
			<input type="submit" name="submit" value="Submit!"/>
		</form>
<?php
echo "<h2>Your Input:</h2>";
echo $username;
echo "<br>";
echo $password;
echo "<br>";
echo $email;
echo "<br>";
echo $PhoneNumber;
echo "<br>";
echo $BankAccount;
echo "<br>";
echo $Address;
echo "<br>";
echo $PostalCode;
echo "<br>";
echo $Birthday;
?>
	</body>
</html>


<?php

?>
