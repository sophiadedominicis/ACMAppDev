/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package studentscheduler;

import java.util.ArrayList;

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
        // TODO code application logic here
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
