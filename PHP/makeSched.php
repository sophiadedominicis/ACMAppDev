<?php
spl_autoload_register(function ($class) {
    include "Course.php";
	include "Schedule.php";
	include "Section.php";
});
$get = json_decode(urldecode($_GET['i']), true);

$sections = array();
foreach($get as $a){
	if($a["course number"] != ""){
		foreach($a["sections"] as $k=>$b){
			$temp = new Section($a["Course Name"], $a["Field of Study"], $a["course number"], intval($a["Units"]), $k);
			foreach($b as $c){
				$temp->addTime($c["day"], $c["from"], $c["to"]);
			}
			array_push($sections, $temp);
		}
	}
}

$GLOBALS['schedules'] = array();
$temp = $sections;

foreach($temp as $k=>$v){
	unset($temp[$k]);
	$curr = array();
	run($temp, $curr, $v);
}

usort($GLOBALS['schedules'], "sortSched");


echo "<strong>".count($GLOBALS['schedules'])." Schedules Generated</strong><br/><br/>";
foreach($GLOBALS['schedules'] as $k=>$a){
	echo "<strong>Schedule #".($k+1)."</strong>";
	echo "<br/>";
	foreach($a->getSchedule() as $b){
		echo $b;
		echo "<br/>";
	}
	echo "<br/>";
	echo "<br/>";
}


function run($sections, $curr, $pick){
	array_push($curr, $pick);
	$temp = $sections;
	foreach($temp as $k=>$v){
		if($v->conflictsWith($pick)){
			unset($temp[$k]);
		}
	}
	if(count($temp)==0){
		$a = new Schedule();
		foreach($curr as $b){
			$a->addSection($b);
		}
		array_push($GLOBALS['schedules'], $a);
	}
	else{
		foreach($temp as $k=>$v){
			unset($temp[$k]);
			run($temp, $curr, $v);
		}
	}
}



function sortSched($a, $b){
	if($a==$b){
		return 0;
	}
	return ($a->getNumClasses() > $b->getNumClasses()) ? -1 : 1;
}



?>
