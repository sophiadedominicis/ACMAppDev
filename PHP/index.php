<html>
	<head>
		<title>Student Schedule Creator</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="css/bootstrap.min.css"></link>
        <script type="text/javascript" src="js/jquery.min.js"></script>
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/bootstrap-timepicker.js"></script>
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
		<div class="container-fluid">
			<h2>Make a Schedule</h2>
			<div class="row">
				<div class="panel-group" id="all-courses">
					<div class="panel panel-default" style="margin-bottom:5px;">
						<div class="panel-heading">
							<h1 class="panel-title pull-left" id="course1"></h1>
							<form class = "form-inline pull-left course-control" role="form" autocomplete="off">
								<div class="entry form-group course-control">
									 Name<label style="color:red;">*</label>: <input id="name1" class="form-control name" name="fields[]" type="text" placeholder="Enter Course Name"/>
									 Field of Study: <input class="form-control fos" name="fields[]" type="text" placeholder="ex. CMSC" style="text-transform: uppercase" maxlength="4"/>
									 Course Number: <input class="form-control cn" name="fields[]" type="text" placeholder="ex. 101" maxlength="3"/>
									 Number of Units: <input class="form-control units" name="fields[]" type="text" placeholder="ex. 1" maxlength="3"/>
								</div>
							</form>
							<button class="btn btn-success btn-add pull-right btn-add-course" type="button">
								<span class="glyphicon glyphicon-plus"></span>
							</button>
							<div class="clearfix"></div>
						</div>
						
						<div class="panel-body">
						<h3>Enter Section Details</h3>
						<div class="col-md-4">
							<div class="panel panel-default">
								<div class="panel-heading">
									<h1 class="panel-title pull-left new-course" id="course1">Section 1</h1>
									<button class="btn btn-success btn-add pull-right btn-add-section glyphicon glyphicon-plus" type="button">
									</button>
									<div class="clearfix"></div>
								</div>
								<div class="panel-body">
									<form class = "form section-control" role="form" autocomplete="off">
										<input type="text" placeholder="CRN Number" class="form-control crn" style="margin:1px;"/>
										<div>
											<div class="row col-md-12 input-group" style="margin:1px;">
												<select class="form-control day">
													<option>Monday</option>
													<option>Tuesday</option>
													<option>Wednesday</option>
													<option>Thursday</option>
													<option>Friday</option>
													<option>Saturday</option>
													<option>Sunday</option>
												</select>
												<span class="input-group-btn">
													<button class="btn btn-success btn-add btn-add-time glyphicon glyphicon-plus" type="button">
													</button>
											   </span>
											</div>
											<div class="row col-md-12">
												<div class="col-md-6 bootstrap-timepicker timepicker">
													<label class="control-label">From:</label>
													<input id="timepicker1" type="text" class="form-control input-small from time">
													<span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
												</div>
												<div class="col-md-6 bootstrap-timepicker timepicker">
													<label class="control-label">To:</label>
													<input id="timepicker2" type="text" class="form-control input-small to time">
													<span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
												</div>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
					</div>
				</div>
			</div>
			<div class="row col-sm-6">
				<button class="btn btn-success btn-submit glyphicon glyphicon-check">  Submit</button>
			</div>
			
			<div class="hide">
				<div class="panel panel-default course-template">
					<div class="panel-heading">
						<h1 class="panel-title pull-left" id="course1"></h1>
						<form class = "form-inline pull-left course-control" role="form" autocomplete="off">
							<div class="entry form-group course-control">
								 Name<label style="color:red;">*</label>: <input id="name1" class="form-control name" name="fields[]" type="text" placeholder="Enter Course Name" required="required"/>
								 Field of Study: <input class="form-control fos" name="fields[]" type="text" placeholder="ex. CMSC" style="text-transform: uppercase" maxlength="4"/>
								 Course Number: <input class="form-control cn" name="fields[]" type="text" placeholder="ex. 101" maxlength="3"/>
								 Number of Units: <input class="form-control units" name="fields[]" type="text" placeholder="ex. 1" maxlength="3"/>
							</div>
						</form>
						<button class="btn btn-success btn-add pull-right btn-add-course" type="button">
							<span class="glyphicon glyphicon-plus"></span>
						</button>
						<div class="clearfix"></div>
					</div>
					
					<div class="panel-body">
						<h3>Enter Section Details</h3>
						<div class="col-md-4 section-template">
							<div class="panel panel-default">
								<div class="panel-heading">
									<h1 class="panel-title pull-left new-course" id="course1">Section 1</h1>
									<button class="btn btn-success btn-add pull-right btn-add-section glyphicon glyphicon-plus" type="button">
									</button>
									<div class="clearfix"></div>
								</div>
								<div class="panel-body">
									<form class = "form section-control" role="form" autocomplete="off">
										<input type="text" placeholder="CRN Number" class="form-control crn" style="margin:1px;"/>
										<div class="time-template">
											<div class="row col-md-12 input-group" style="margin:1px;">
												<select class="form-control day">
													<option>Monday</option>
													<option>Tuesday</option>
													<option>Wednesday</option>
													<option>Thursday</option>
													<option>Friday</option>
													<option>Saturday</option>
													<option>Sunday</option>
												</select>
												<span class="input-group-btn">
													<button class="btn btn-success btn-add btn-add-time glyphicon glyphicon-plus" type="button">
													</button>
											   </span>
											</div>
											<div class="row col-md-12">
												<div class="col-md-6 bootstrap-timepicker timepicker">
													<label class="control-label">From:</label>
													<input id="timepicker1" type="text" class="form-control input-small from time">
													<span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
												</div>
												<div class="col-md-6 bootstrap-timepicker timepicker">
													<label class="control-label">To:</label>
													<input id="timepicker2" type="text" class="form-control input-small to time">
													<span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
												</div>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<script>
			var $courseTemplate = $(".course-template");
			var $sectionTemplate = $(".section-template");
			var $timeTemplate = $(".time-template");
			var numCourse = 1;
			var numSection = 1;
			
			$(document).on("click", ".btn-add-course", function (e) {
				var $newPanel = $courseTemplate.clone();
				numCourse++;
				console.log("add course");
				$newPanel.find("h1").attr("id", "course"+numCourse);
				$newPanel.find("#name1").attr("id", "name"+numCourse);
				$newPanel.find("h1").each(function(){
						if($(this).attr("class").indexOf("new-course")>-1){
							$(this).text("Section "+(++numSection));
						}
				});
				$("#all-courses").append($newPanel);
			});
			
			$(document).on("click", ".btn-add-section", function (e) {
				var $newPanel = $sectionTemplate.clone();
				console.log("add section");
				$newPanel.find("h1").text("Section "+(++numSection));
				$(e.target).parent().parent().parent().parent().append($newPanel);
			});
			
			$(document).on("click", ".btn-add-time", function (e) {
				var $newPanel = $timeTemplate.clone();
				console.log("add time");
				$(e.target).parent().parent().parent().parent().append($newPanel);
			});
			
			$(document).on("click", ".btn-submit", function (e) {
				console.log("submit");
				var $form = $("form");
				var output = {};
				var courseNum = -1;
				var numSection = 0;
				var numDay = 0;
				$form.each(function(){
					var c = $(this).attr("class");
					if(c.indexOf("course-control")>-1){
						courseNum++;
						numSection = 0;
						if(output[courseNum] == undefined){
							output[courseNum] = {};
						}
						
						$(this).find("input, select").each(function(){
							var d = $(this).attr("class");
							if(d.indexOf("name")>-1){
								output[courseNum]["Course Name"] = $(this).val();
							}
							if(d.indexOf("fos")>-1){
								output[courseNum]["Field of Study"] = $(this).val();
							}
							if(d.indexOf("cn")>-1){
								output[courseNum]["course number"] = $(this).val();
							}
							if(d.indexOf("units")>-1){
								output[courseNum]["Units"] = $(this).val();
							}
						});
					}
					
					if(c.indexOf("section-control")>-1){
						if(output[courseNum] == undefined){
							output[courseNum] = {};
						}
						if(output[courseNum]["sections"] == undefined){
							output[courseNum]["sections"] = {};
						}
						
						$(this).find("input, select").each(function(){
							var d = $(this).attr("class");
							if(output[courseNum]["sections"][numSection] == undefined){
								output[courseNum]["sections"][numSection] = {};
							}
							if(output[courseNum]["sections"][numSection][numDay] == undefined){
								output[courseNum]["sections"][numSection][numDay] = {};
							}
							
							if(d.indexOf("crn")>-1){
								output[courseNum]["sections"][numSection]["crn"] = $(this).val();
							}
							if(d.indexOf("day")>-1){
								output[courseNum]["sections"][numSection][numDay]["day"] = $(this).val();
							}
							if(d.indexOf("to")>-1){
								output[courseNum]["sections"][numSection][numDay]["to"] = $(this).val();
							}
							if(d.indexOf("from")>-1){
								output[courseNum]["sections"][numSection][numDay]["from"] = $(this).val();
							}
							var a = output[courseNum]["sections"][numSection][numDay];
							if(a["day"] != undefined && a["to"] != undefined && a["from"] != undefined){
								numDay++;
							}
						});
						numDay = 0;
						numSection++;
					}
				});
				var json = JSON.stringify(output);
				console.log(output);
				var win = window.open("/sched/makeSched.php?i="+encodeURIComponent(json), '_blank');
				win.focus();
			});
			
			$(document).on('keyup', ".name", function(e){
				var id = e.target.getAttribute("id");
				id = id.substring(5, id.length-1);
				$('#course'+id).html($('#name'+id).val());
				if(!$("#hr"+id).length){
					$("<br/><hr id=\"hr"+id+"\" style=\"width:100%; border-top:1px solid #FFFFFF;\"/>").insertAfter("#course"+id);
				}
			  });
			  $('.time').timepicker({minuteStep:5, defaultTime:"12:00 AM"});
		</script>
	</body>
</html>