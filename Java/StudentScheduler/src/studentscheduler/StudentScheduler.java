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
public class StudentScheduler {
    public static ArrayList<Schedule> allSchedules = new ArrayList<>();
    public static ArrayList<Section> allSections = new ArrayList<>();
    /**
     * @param args the command line arguments
     */
    public static void main(String[] args) {
        Scanner scan = new Scanner(System.in);
        
        addMoreCourses(scan);
        System.out.println("\n");
        System.out.println("Do you want to add another course?\t [Y/N]");
        String answer = scan.nextLine();
        while(answer.toLowerCase().equals("y")){
            addMoreCourses(scan);
            System.out.println("\n");
            System.out.println("Do you want to add another course?\t [Y/N]");
            answer = scan.nextLine();
        }
        System.out.println("\n\n");
        
        //generate schedules
        for(int i=0; i<allSections.size(); i++){
            ArrayList<Section> temp = new ArrayList<>(allSections);
            Section a = temp.get(i);
            int j=0;
            while(j<=i){
                temp.remove(0);
                j++;
            }
            ArrayList<Section> curr = new ArrayList<>();
            run(temp, curr, a);
        }
        
        System.out.println(allSchedules.size()+" Schedules Generated");
        for(Schedule a : allSchedules){
            System.out.println(a);
        }
    }
    
    private static void addMoreCourses(Scanner scan){
        System.out.println("Enter a course name");
        String courseName = scan.nextLine();
        addMoreSections(courseName, scan);
        System.out.println("Do you want to add another section for that course?\t [Y/N]");
        String answer = scan.nextLine();
        
        while(answer.toLowerCase().equals("y")){
            addMoreSections(courseName, scan);
            System.out.println("Do you want to add another section for that course?\t [Y/N]");
            answer = scan.nextLine();
        }
    }
    
    private static void addMoreSections(String courseName, Scanner scan){
        Section tempSection = new Section(courseName, "", 0, 1, "");
        String[] times = addMoreTime(scan);
        tempSection.addTime(times[0], times[1], times[2]);
        System.out.println("Do you want to add another day/time for that section?\t [Y/N]");
        String answer = scan.nextLine();
        while(answer.toLowerCase().equals("y")){
            times = addMoreTime(scan);
            tempSection.addTime(times[0], times[1], times[2]);
            System.out.println("Do you want to add another day/time for that section?\t [Y/N]");
            answer = scan.nextLine();
        }
        allSections.add(tempSection);
    }
    
    private static String[] addMoreTime(Scanner scan){
        System.out.println("Enter day of the week");
        String day = scan.nextLine();
        System.out.println("Enter the start time");
        String from = scan.nextLine();
        System.out.println("Enter the end time");
        String to = scan.nextLine();
        
        String[] returnTime = {day, from, to};
        return returnTime;
    }
    
    public static void run(ArrayList<Section> sections, ArrayList<Section> curr, Section pick){
        curr.add(pick);
        ArrayList<Section> temp = new ArrayList<>(sections);
        for(int i=0; i<temp.size(); i++){
            if(temp.get(i).conflictsWith(pick)){
                temp.remove(i--);
            }
        }
        
        if(temp.isEmpty()){
            Schedule a = new Schedule();
            for(Section b : curr){
                a.addSection(b);
            }
            allSchedules.add(a);
        }
        else{
            for(int i=0; i<temp.size(); i++){
                Section a = temp.get(i);
                int j=0;
                while(j<=i){
                    temp.remove(0);
                    j++;
                }
                run(temp, curr, a);
            }
        }
    }
    
}
