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
    public static ArrayList<Schedule> allSchedules = new ArrayList<Schedule>();
    /**
     * @param args the command line arguments
     */
    public static void main(String[] args) {
        ArrayList<Section> sections = new ArrayList();
        
        Scanner scan = new Scanner(System.in);
        System.out.println("Enter a course name");
        String courseName = scan.nextLine();
        Section tempSection = new Section(courseName, "", 0, 1, "");
        
        System.out.println("Enter day of the week");
        String day = scan.nextLine();
        System.out.println("Enter the start time");
        String from = scan.nextLine();
        System.out.println("Enter the end time");
        String to = scan.nextLine();
        
        tempSection.addTime(day, from, to);
        
        
    }
    
    public static void run(ArrayList<Section> sections, ArrayList<Section> curr, Section pick){
        curr.add(pick);
        ArrayList<Section> temp = sections;
        for(int i=0; i<temp.size(); i++){
            if(temp.get(i).conflictsWith(pick)){
                temp.remove(i);
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
            for(Section a : temp){
                temp.remove(0);
                run(temp, curr, a);
            }
        }
    }
    
}
