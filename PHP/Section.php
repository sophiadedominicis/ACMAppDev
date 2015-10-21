<?php
class Section extends Course{
	private $earliestTime;
	private $latestTime;
	private $meetsFriday;
	public $meetingTime;
	private $crn;	
	public function __construct($courseTitle, $fos, $courseNum, $units, $crn){
		parent::__construct($courseTitle, $fos, $courseNum, $units);
		$this->meetsFriday = false;
		$this->crn = $crn;
	}

	public function addTime($day, $from, $to){
		$this->meetingTime[$day] = ["from"=>strtotime($from),  "to"=>strtotime($to)];
		if($day == "Friday"){
			$this->meetsFriday = true;
		}
		if(!isset($this->earliestTime)){
			$this->earliestTime = array($this->dayToInt($day), strtotime($from));
		}
		else if($this->earliestTime[0] > $this->dayToInt($day)){
			if($this->earliestTime[1] > strtotime($from)){
				$this->earliestTime = array($this->dayToInt($day), strtotime($from));
			}
		}

		if(!isset($this->latestTime)){
			$this->latestTime = array($this->dayToInt($day), strtotime($from));
		}
		else if($this->latestTime[0] < $this->dayToInt($day)){
			if($this->latestTime[1] < strtotime($from)){
				$this->latestTime = array($this->dayToInt($day), strtotime($from));
			}
		}
	}
	
	public function conflictsWith($other){
		if($this->getFieldOfStudy() == $other->getFieldOfStudy() && $this->getCourseNumber() == $other->getCourseNumber() && $this->getCourseTitle() == $other->getCourseTitle()){
			return true;
		}
		else{
			foreach($this->meetingTime as $k=>$a){
				if(isset($other->meetingTime[$k])){
					if($a["from"]<=$other->meetingTime[$k]["to"] && $a["to"]>=$other->meetingTime[$k]["from"]){
						return true;
					}
				}
			}
		}
		return false;
	}
	
	public function getEarliestTime(){
		return $this->earliestTime;
	}
	
	public function getLatestTime(){
		return $this->latestTime;
	}
	
	public function meetsFriday(){
		return $this->meetsFriday;
	}
	
	public function getCRN(){
		return $this->crn;
	}
	
	public function __toString(){
		$me = $this->getCourseTitle()." on ".$this->intToDay($this->getEarliestTime()[0])." at ".date("g:i A", $this->getEarliestTime()[1]);
		return $me;
	}	
	
	private function dayToInt($day){
		switch($day){
			case "Monday":				
				return 0;
			case "Tuesday":				
				return 1;
			case "Wednesday":				
				return 2;
			case "Thursday":				
				return 3;
			case "Friday":				
				return 4;
			case "Saturday":				
				return 5;
			case "Sunday":				
				return 6;
		}
	}	
	
	private function intToDay($d){
		switch($d){
			case 0:
				return "Monday";
			case 1:
				return "Tuesday";
			case 2:
				return "Wednesday";
			case 3:
				return "Thursday";
			case 4:	
				return "Friday";
			case 5:
				return "Saturday";
			case 6:
				return "Sunday";
		}
	}
}
?>