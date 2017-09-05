<?php 

$complaint = new Complaints();
//$complaint->createComplaint("2016-2-23","10:10","mess","non veg","A","14mse1059");
$complaint->getComplaintsByRegno("14mse1059");
$complaint->getComplaintsByType("A","pluming","2016-2-23","2016-2-23");
echo "<br>";
$complaint->updateComplaint(3,4);

/**
* 
*/
class Complaints
{
	
	function __construct()
	{
		# code...
	}

	public function updateComplaint($cid,$status)
	{
		require 'Connection.php';
		if(!$conn->connect_error){
			$sql = "update complaints set status='".$status."' where cid='".$cid."';";
			$result=$conn->query($sql);
			if($result===TRUE)
			echo "_DONE";
			else
				echo $conn->error;
		}
		else{
			echo $conn->connect_error;
		}
		mysqli_close($conn);
	}

	public function getComplaintsByType($block,$type,$fdat,$tdat)
	{
		require 'Connection.php';
		if(!$conn->connect_error){
			$sql = "SELECT complaints.cid as cid,'date','time','type',user.regno,'name',roomno FROM complaints join complainer on complainer.cid=complaints.cid join user on user.regno=complainer.regno where user.block='$block' and complaints.type='$type' and complaints.date between '$fdat' and '$tdat';";
			$result=$conn->query($sql);
			$row = array();
			while($row[]=$result->fetch_assoc())
			{}
			echo json_encode($row);
		}
		else{
			echo $conn->connect_error;
		}
		mysqli_close($conn);
	}

	public function getComplaintsByDate($block,$fdat,$tdat)
	{
		require 'Connection.php';
		if(!$conn->connect_error){
			$sql = "SELECT complaints.cid as cid,'date','time','type',user.regno,'name',roomno FROM complaints join complainer on complainer.cid=complaints.cid join user on user.regno=complainer.regno where user.block='$block' and complaints.date='$dat';";
			$result=$conn->query($sql);
			$row = array();
			while($row[]=$result->fetch_assoc())
			{}
			echo json_encode($row);
		}
		else{
			echo $conn->connect_error;
		}
		mysqli_close($conn);
	}
	public function getComplaintsByRegno($username)
	{
		require 'Connection.php';
		if(!$conn->connect_error){
			$sql = "SELECT complaints.cid as cid,'date','time','type' FROM complaints join complainer on complainer.cid=complaints.cid join user on user.regno=complainer.regno where user.regno='".$username."';";
			$result=$conn->query($sql);
			//echo $result->num_rows."<br>";
			$row = array();
			while($row[]=$result->fetch_assoc())
				{}
			echo json_encode($row)."<br>";
		}
		else{
			echo $conn->connect_error;
		}
		mysqli_close($conn);
	}
	public function createComplaint($date,$time,$type,$desc,$block,$regno)
	{
		require 'Connection.php';
		if(!$conn->connect_error){
			$sql = "INSERT INTO complaints (date,time,type,`desc`,status,feedback,block) VALUES ('".$date."','".$time."','".$type."','".$desc."','1','-','".$block."');";
			$result=$conn->query($sql);
			if ($result===TRUE) {
				$cid=$conn->insert_id;
				$sql = "INSERT INTO complainer(cid,regno) VALUES ('".$cid."', '".$regno."');";
				$result=$conn->query($sql);
			}
			else
				echo "error".$conn->error;
			
		}
		else{
			echo $conn->connect_error;
		}
		mysqli_close($conn);
	}
}
?>