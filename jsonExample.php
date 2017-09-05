
<?php 

class Objs
{
	public $name, $age;
}

$objs = array();

$obj = new Objs();
$obj->name = "Rohith";
$obj->age = "21";
$objs[0]=$obj;

$obj = new Objs();
$obj->name = "Ganesh";
$obj->age = "22";
$objs[1]=$obj;
$json_obj = json_encode($objs);
$jsn = json_decode($json_obj,true);
echo $jsn[0]['name'];
?>