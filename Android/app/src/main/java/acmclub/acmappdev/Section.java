
package acmclub.acmappdev;

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
        day = day.toLowerCase();
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
        
        if (latestTime == null) {
            latestTime = new int[2];
            latestTime[0] = dayToInt(day);
            latestTime[1] = to;
        } 
        else if (latestTime[1] < to) {
            latestTime[1] = to;
        }
        
        if (day.equals("friday")) {
            meetsFriday = true;
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

    @Override
    public String toString(){
        Calendar t = Calendar.getInstance();
        t.setTimeInMillis(getEarliestTime()[1]);
        String ampm = t.get(Calendar.AM_PM)==0 ? "AM":"PM";
        String minutes = String.format("%02d", t.get(Calendar.MINUTE));
        String time = t.get(Calendar.HOUR)+":"+minutes+" "+ampm;
        return getCourseTitle()+" every "+intToDay(getEarliestTime()[0])+" at "+time;
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
        day = day.toLowerCase();
        switch (day) {
            case "monday":
                return 0;
            case "tuesday":
                return 1;
            case "wednesday":
                return 2;
            case "thursday":
                return 3;
            case "friday":
                return 4;
            case "saturday":
                return 5;
            case "sunday":
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