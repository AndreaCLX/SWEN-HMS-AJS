<?php
$database = mysqli_connect('localhost','root','','hms');
$Name = @$_POST['Name'];
$Email = @$_POST['Email'];
$ContactNumber = @$_POST['ContactNumber'];
$Address = @$_POST['Address'];
$PostalCode = @$_POST['PostalCode'];
$Record = @$_POST['Record'];
$Country = @$_POST['Country'];

if($_POST){

    $query = "INSERT INTO `guest` (`Name`, `Email` , `ContactNumber` , `Address` , `PostalCode` , `Record` , `Country`) VALUES ('$Name' , '$Email' , '$ContactNumber' , '$Address' , '$PostalCode' , '$Record' , '$Country')";

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

        Name: <input type="text" name="Name" /> <br />
        Email: <input type="text" name="Email" /> <br />
        ContactNumber: <input type="text" name="ContactNumber" /> <br />
        Address: <input type="text" name="Address" /> <br />
        PostalCode: <input type="text" name="PostalCode" /> <br />
        Record: <input type="text" name="Record" /> <br />
        Country: <input type="text" name="Country" /> <br />
        <input type="submit" />
    </form>
    </body>
</html>