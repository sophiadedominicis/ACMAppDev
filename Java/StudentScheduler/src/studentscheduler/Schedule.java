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
    private ArrayList<Section> listOfSections = new ArrayList<>();
    private int numberOfClasses;
    private double numberOfUnits;
    private int[] earliestTime;
    private int[] latestTime;
    private boolean fridayFree;
    
    public Schedule(){
    }
    
    public void addSection(Section sec){
        listOfSections.add(sec);
        numberOfClasses++;
        numberOfUnits += sec.getNumUnits();
        
        if(earliestTime == null){
            earliestTime = sec.getEarliestTime();
        }
        else if(earliestTime[1] > sec.getEarliestTime()[1]){
            earliestTime[0] = sec.getEarliestTime()[0];
            earliestTime[1] = sec.getEarliestTime()[1];
        }

        if(latestTime == null){
            latestTime = sec.getLatestTime();
        }
        else if(latestTime[1] < sec.getLatestTime()[1]){
            latestTime[0] = sec.getLatestTime()[0];
            latestTime[1] = sec.getLatestTime()[1];
        }
        
        if(sec.meetsFriday()){
            fridayFree = false;
        }
    }
    
    @Override
    public String toString(){
        StringBuilder sb = new StringBuilder();
        for(Section a : listOfSections){
            sb.append(a);
            sb.append("\n");
        }
        return sb.toString();
    }
    
    public ArrayList<Section> getSchedule(){
        return listOfSections;
    }
    
    public int getNumClasses(){
        return numberOfClasses;
    }
    
    public int[] getEarliestTime(){
        return earliestTime;
    }
    
    public int[] getlatestTime(){
        return latestTime;
    }
    
    public double getNumUnits(){
        return numberOfUnits;
    }
    
    public boolean fridayFree(){
        return fridayFree;
    }
}
