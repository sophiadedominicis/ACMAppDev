/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package studentscheduler;

/**
 *
 * @author Mike
 */
import java.util.ArrayList;

public class Schedule {
    private ArrayList<Section> listOfSections;
    private int numberOfClasses;
    private double numberOfUnits;
    private int earliestTime;
    private int latestTime;
    private boolean fridayFree;
    
    public Schedule(){
    }
    
    public void addSection(Section sec){
        listOfSections.add(sec);
        numberOfClasses++;
        numberOfUnits += sec.getNumUnits();
        if(sec.getEarliestTime() < earliestTime){
            earliestTime = sec.getEarliestTime();
        }
        if(sec.getLatestTime() > latestTime){
            latestTime = sec.getLatestTime();
        }
        if(sec.meetsFriday()){
            fridayFree = false;
        }
    }
    
    public ArrayList<Section> getSchedule(){
        return listOfSections;
    }
    
    public ArrayList<Course> getCourses(){
        ArrayList<Course> courses = new ArrayList<>();
        for(Section c : listOfSections){
            courses.add((Course) Section);
        }
        return courses;
    }
    
    public int getNumClasses(){
        return numberOfClasses;
    }
    
    public int getEarliestTime(){
        return earliestTime;
    }
    
    public int getlatestTime(){
        return latestTime;
    }
    
    public double getNumUnits(){
        return numberOfUnits;
    }
    
    public boolean fridayFree(){
        return fridayFree;
    }
}
