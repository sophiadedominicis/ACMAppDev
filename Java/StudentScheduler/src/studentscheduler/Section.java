
package studentscheduler;

import java.util.*;
import static studentscheduler.strtotime.strtotime;

public class Section extends Course {
    private int[] earliestTime;
    private int[] latestTime;
    private boolean meetsFriday;
    public HashMap<String, HashMap<String, Integer>> meetingTime = new HashMap<>();
    private String crn;

    public Section(String courseTitle, String fos, int courseNum, double units, String crn) {
        super(courseTitle, fos, courseNum, units);
        meetsFriday = false;
        this.crn = crn;
    }

    public void addTime(String day, String from1, String to1) {
        int from = (int) strtotime(from1).getTime();
        int to = (int) strtotime(to1).getTime();
        
        HashMap<String, Integer> temp = new HashMap<>();
        temp.put("from", from);
        temp.put("to", to);
        meetingTime.put(day, temp);
        
        if (earliestTime == null) {
            earliestTime = new int[2];
            earliestTime[0] = dayToInt(day);
            earliestTime[1] = from;
        } 
        else if (earliestTime[1] > from) {
            earliestTime[0] = dayToInt(day);
            earliestTime[1] = from;
        }
        
        if (day.equals("Friday")) {
            meetsFriday = true;
        }
        
        if (latestTime == null) {
            latestTime = new int[2];
            latestTime[0] = dayToInt(day);
            latestTime[1] = to;
        } 
        else if (latestTime[1] < to) {
            latestTime[1] = to;
        }
    }

    public boolean conflictsWith(Section other) {
        if (getField().equals(other.getField()) && getCourseNumber() == other.getCourseNumber() && getCourseTitle().equals(other.getCourseTitle())) {
            return true;
        } 
        else {
            for(Map.Entry<String, HashMap<String, Integer>> a : meetingTime.entrySet()){
                if(other.meetingTime.containsKey(a.getKey())){
                    if(a.getValue().get("from") <= other.meetingTime.get(a.getKey()).get("to") && a.getValue().get("to") >= other.meetingTime.get(a.getKey()).get("from")){
                        return true;
                    }
                }
            }
        }
        return false;
    }

    public int[] getEarliestTime() {
        return earliestTime;
    }

    public int[] getLatestTime() {
        return latestTime;
    }

    public boolean meetsFriday() {
        return meetsFriday;
    }

    public String getCRN() {
        return crn;
    }

    //Return number of course units for course entry
    public double getNumUnits(){
        return super.getUnits();
    }

    private int dayToInt(String day) {
        switch (day) {
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
            default: return -1;
        }
    }

    private String intToDay(int day) {
        switch (day) {
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
            default: return "";
        }
    }
}