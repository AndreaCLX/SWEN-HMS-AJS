<?php
$database = mysqli_connect('localhost','root','','hms');
$type = @$_POST['Type'];
$location = @$_POST['Location'];
$status = @$_POST['Status'];
$rate = @$_POST['Rate'];

if($_POST){

    $query = "INSERT INTO `room` (`Type` , `Location` ,`Status` , `Rate`) VALUES ('$type' , '$location' , '$status' , '$rate')";
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

    Type: <input type="text" name="Type" /> <br />
    Location: <input type="text" name="Location" /> <br />
    Status: <input type="text" name="Status" /> <br />
    Rate: <input type="text" name="Rate" /> <br />

    <input type="submit" />
</form>
</body>
</html>