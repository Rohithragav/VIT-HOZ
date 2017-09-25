<?php
/**
* 
*/
class Warden
{
	var $username;
	function __construct()
	{
		# code...
	}

	public function wardenSignIn($username,$password)
	{
		$this->username=$username;
		require 'Connection.php';
		if(!$conn->connect_error){
			$sql = "SELECT name,block FROM wardon where username='".$username."' and pass='".$password."'";
			$result=$conn->query($sql);
			$row=$result->fetch_assoc();
			return json_encode($row);
		}
		else{
			//echo $conn->connect_error;
			return "error";
		}
		mysqli_close($conn);
	}

	public function updatePassword($password)
	{
		require 'Connection.php';
		if(!$conn->connect_error){
			$sql = "UPDATE wardon SET pass='".$password."' WHERE username='".$this->username."';";
			$conn->query($sql);
			return "done";
		}
		else{
			echo $conn->connect_error;
			return "error";
		}
		mysqli_close($conn);
	}
	
}
?>