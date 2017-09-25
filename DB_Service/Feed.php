<?php
$today=Date("Y/m/d");
echo $today;
/**
*
*/
class Feeds 
{
	function __construct($feedname,$feedDesc,$feedimage,$date,$block)
	{
		# INSERT INTO `hostelproj`.`feeds` (`fid`, `name`, `desc`, `img`, `expdate`, `block`) VALUES ('1', 'dff', 'fdfsfs', 'df', '23/3/2017', 'A');

		require 'Connection.php';
		if(!$conn->connect_error){
			$sql = "INSERT INTO feeds (`name`, `desc`, `img`, `expdate`, `block`) VALUES ('$feedname', '$feedDesc', '$feedimage', '$date', '$block');";
			$result=$conn->query($sql);
			if ($result===TRUE) {
				return "DONE";
			}

		}
		else{
			return "error";
			//echo $conn->connect_error;
		}
		mysqli_close($conn);
		return "error";
	}

	public function getFeedsByBlock($block)
	{
		require 'Connection.php';
		if(!$conn->connect_error){
			$sql = "SELECT * FROM feeds where block='".$block."';";
			$result=$conn->query($sql);
			$row = array();
			while ($row[]=$result->fetch_assoc()) {}
			return json_encode($row);
		}
		else{
			return "error";
			//echo $conn->connect_error;
		}
		mysqli_close($conn);
	}

	public function getFeedsById($fid)
	{
		require 'Connection.php';
		if(!$conn->connect_error){
			$sql = "SELECT * FROM feeds where fid='$fid';";
			$result=$conn->query($sql);
			$row=$result->fetch_assoc();
			return json_encode($row);
		}
		else{
			return "error";
			//echo $conn->connect_error;
		}
		mysqli_close($conn);
		return "error";
		
	}

	public function getTodayFeeds($date)
	{
		require 'Connection.php';
		if(!$conn->connect_error){
			$sql = "SELECT * FROM feeds where expdate='$date';";
			$result=$conn->query($sql);
			$row=$result->fetch_assoc();
			return json_encode($row);
		}
		else{
			//echo $conn->connect_error;
			return "error";
		}
		mysqli_close($conn);
		return "error";
	}

	public function deleteFeed($fid)
	{
		# DELETE FROM `hostelproj`.`feeds` WHERE `fid`='1';
		require 'Connection.php';
		if(!$conn->connect_error){
			$sql = "DELETE FROM feeds WHERE fid='$fid';";
			$result=$conn->query($sql);
			if ($result===TRUE) {
				return "DONE";
			}
		}
		else{
			//echo $conn->connect_error;
			return "error";
		}
		mysqli_close($conn);
	}
}
?>