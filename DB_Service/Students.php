<?php

/**
* 
*/
class Studends
{
	public $username;
	function __construct()
	{	
	}

	public function login($username,$password)
	{
		require 'Connection.php';
		if(!$conn->connect_error){
			$sql = "SELECT * FROM user where regno='$username' and pass='$password' ;";
			$result=$conn->query($sql);
			$row=$result->fetch_assoc();
			echo json_encode($row);
		}
		else{
			echo $conn->connect_error;
		}
		mysqli_close($conn);
	}

	public function changePassword($username,$newpassword)
	{
		require 'Connection.php';
		if(!$conn->connect_error){
			$sql = "UPDATE user SET pass='$newpassword' WHERE regno='$username';";
			$result=$conn->query($sql);
		}
		else{
			echo $conn->connect_error;
		}
		mysqli_close($conn);
	}

	public function getDetails($username)
	{
		require 'Connection.php';
		if(!$conn->connect_error){
			$sql = "SELECT * FROM user where regno='$username';";
			$result=$conn->query($sql);
			$row=$result->fetch_assoc();
			echo json_encode($row);
		}
		else{
			echo $conn->connect_error;
		}
		mysqli_close($conn);
	}
}
?>