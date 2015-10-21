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
	return ($a->getScore() > $b->getScore()) ? -1 : 1;
}
?>

<html>
	<head>
		<title>Student Schedule Creator</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="css/bootstrap.min.css"></link>
        <script type="text/javascript" src="js/jquery.min.js"></script>
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
		<script>
		  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
		  ga('create', 'UA-69105822-1', 'auto');
		  ga('send', 'pageview');
		</script>
	</head>
	<body>
	<script>
		$(document).ready(function(){
			$('[data-toggle="popover"]').popover();   
		});
		
		$(document).on("click", ".btn-expand", function (e) {
			$('.collapse:not(.in)').each(function (index) {
				$(this).addClass("in");
			});
			$(this).text(' Collapse All Schedules');
			$(this).removeClass("glyphicon-collapse-down btn-expand");
			$(this).addClass("glyphicon-collapse-up btn-collapse");
		});
		
		$(document).on("click", ".btn-collapse", function (e) {
			$('.collapse:not(.in)').each(function (index) {
				$(this).collapse("toggle");
			});
			$('.collapse.in').each(function (index) {
				$(this).removeClass("in");
			});
			$(this).text(' Expand All Schedules');
			$(this).addClass("glyphicon-collapse-down btn-expand");
			$(this).removeClass("glyphicon-collapse-up btn-collapse");
		});
	</script>
		<div class="container-fluid">
			<div class="row col-md-12">
				<?php 
				$i = 0;
				foreach($finalSchedules as $k=>$v){
					if($v->getNumUnits() >= 3.5){
						$i += 1;
					}
				}
				?>
				
				<div class="row col-sm-12"><div class="col-sm-6"><?php echo "<h1><strong>".$i."</strong> <a href='#' style='color:#ffffff;' data-toggle='popover' title='Definition of Compliant' data-content='Compliant schedules have at least 3.5 units, as per UR requirements.'>Compliant Schedules Generated</a></h1>";?>
				</div><div class="col-sm-6"><h1><button class="btn btn-success pull-right btn-expand glyphicon glyphicon-collapse-down" type="button"> Expand All Schedules</button></h1></div></div>
				<hr width="100%" />
				
				<div class="panel-group">
					<?php 
					$num = 0;
					foreach($finalSchedules as $k=>$a){
						if($a->getNumUnits() < 3.5){
							continue;
						}
						if($num%4==0){
							echo "<div class='row' style='margin:2px;'>";
						}
						$in = "";
						if($num<4){
							$in = " in";
						}
						echo "<div class='col-md-3'>";
						echo "<div class='panel panel-default'>";
						echo "<div class='panel-heading panel-title' data-toggle='collapse' data-target='#collapse".$num."' style='cursor: pointer;'>";
						echo "<a data-toggle='collapse' href='#collapse".$num."'>".$a->getNumClasses()." classes, ".$a->getNumUnits()." units, with ".reset($a->getCPD())." classes every ".key($a->getCPD())." and score ".$a->getScore()."</a></div>";
						echo "<div class='panel-collapse collapse panel-body".$in."' id='collapse".$num."'>";
						echo "<table class='table table-condensed table-responsive'>";
						foreach($a->getSchedule() as $b){
							echo "<tr><td>";
							echo $b;
							echo "</tr></td>";
						}
						echo "</table></div></div></div>";
						if($num%4==3 || $k==count($GLOBALS['schedules'])){
							echo "</div>";
						}
						$num += 1;
					}
					?>
				</div>
			</div>
		</div>
	</body>
</html>
