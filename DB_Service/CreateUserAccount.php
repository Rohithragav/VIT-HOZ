<?php 
require 'Connection.php';
function signupEmail($emailid)
{

$a="abcdefghijklmnopqrstuvwxyz";
$password="_".rand(0,9)."".rand(0,9)."";
$password.=$a[rand(0,25)].$a[rand(0,25)].$a[rand(0,25)];
$password.=rand(0,9).rand(0,9);
echo $password;

	if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
	} 

	$sql = "INSERT INTO MyGuests (firstname, lastname, email)
	VALUES ('John', 'Doe', 'john@example.com')";

	if ($conn->query($sql) === TRUE) {
    	echo "New record created successfully";
		sendMail($emailid,$password);
	} else {
    	echo "Error: " . $sql . "<br>" . $conn->error;
	}

$conn->close();
}
function sendMail($mailid,$password)
{
	
}
?>