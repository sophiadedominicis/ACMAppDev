/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package studentscheduler;
import java.util.*;

/**
 *
 * @author Mike
 */
public class Section extends Course{
	private String[] earliestTime;
	private String[] latestTime;
	private boolean meetsFriday;
	public HashMap<String, HashMap<String, String>> meetingTime;
	private String crn;	
	
    public void Section(String courseTitle, String fos, int courseNum, double units, String crn){
        super(courseTime, fos, courseNum, units, crn);
		meetsFriday = false;
		this.crn = crn;
    }

	public void addTime(String day, String from, String to){
		meetingTime[day] = ["from"=>strtotime(from),  "to"=>strtotime(to)];
		if(day.equals("Friday")){
			meetsFriday = true;
		}
		if(!isset(earliestTime)){
			earliestTime = array(dayToInt(day), strtotime(from));
		}
		else if(earliestTime[0] > dayToInt(day)){
			if(earliestTime[1] > strtotime(from)){
				earliestTime = array(dayToInt(day), strtotime(from));
			}
		}

		if(!isset(latestTime)){
			latestTime = array(dayToInt(day), strtotime(from));
		}
		else if(latestTime[0] < dayToInt(day)){
			if(latestTime[1] < strtotime(from)){
				latestTime = array(dayToInt(day), strtotime(from));
			}
		}
	}
	
	public boolean conflictsWith(Section other){
		if(getFieldOfStudy() == other.getFieldOfStudy() && getCourseNumber() == other.getCourseNumber() && getCourseTitle() == other.getCourseTitle()){
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
		return earliestTime;
	}
	
	public function getLatestTime(){
		return latestTime;
	}
	
	public function meetsFriday(){
		return meetsFriday;
	}
	
	public function getCRN(){
		return crn;
	}
	
	public function __toString(){
		String me = getCourseTitle()+" on "+intToDay($this->getEarliestTime()[0])+" at "+date("g:i A", $this->getEarliestTime()[1]);
		return me;
	}	
	
	private function dayToInt(String day){
		switch(day){
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
	
	private function intToDay(int d){
		switch(d){
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
