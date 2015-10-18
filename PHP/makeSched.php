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
			$crn = $k;
			if(isset($a["crn"])){
				$crn = $a["crn"];
			}
			$temp = new Section($a["Course Name"], $a["Field of Study"], $a["course number"], intval($a["Units"]), $crn);
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

$finalSchedules = $GLOBALS['schedules'];

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

<html>
	<head>
		<title>Student Schedule Creator</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="css/bootstrap.min.css"></link>
        <script type="text/javascript" src="js/jquery.min.js"></script>
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
	</head>
	<body>
		<div class="container-fluid">
			<div class="row col-sm-12">
				<div class="panel-group">
			<?php 
			echo "<strong>".count($GLOBALS['schedules'])." Schedules Generated</strong><br/><br/>";
			foreach($GLOBALS['schedules'] as $k=>$a){
				if($k%3==0){
					echo "<div class='row' style='margin:2px;'>";
				}
				echo "<div class='col-sm-4'>";
				echo "<div class='panel panel-default'>";
				echo "<div class='panel-heading panel-title'>";
				echo "<a data-toggle='collapse' href='#collapse".$k."'>".$a->getNumClasses()." classes, ".$a->getNumUnits()." units, with ".reset($a->getCPD())." classes every ".key($a->getCPD())."</a></div>";
				echo "<div class='panel-collapse collapse' id='collapse".$k."'>";
				foreach($a->getSchedule() as $b){
					echo "<p>".$b."</p>";
				}
				echo "</div></div></div>";
				if($k%3==2){
					echo "</div>";
				}
			}
			?>
				</div>
			</div>
		</div>
	</body>
</html>
