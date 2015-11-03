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

    /**
     * @param args the command line arguments
     */
    public static void main(String[] args) {
        // TODO code application logic here
    }
    
    public static void run(ArrayList<Section> sections, ArrayList<Section> curr, Section pick){
        curr.add(pick);
        ArrayList<Section> temp = sections;
        int i = 0;
        for(Section k : temp){
            if(k.conflictsWith(pick)){
                temp.remove(i);
            }
            i++;
        }
        if(count($temp)==0){
            $a = new Schedule();
            foreach($curr as $b){
                $a->addSection($b);
            }
            array_push($GLOBALS['schedules'], $a);
        }
        else{
            foreach($temp as $k=>$v){
                unset($temp[$k]);
                run($temp, $curr, $v);
            }
        }
    }
    
}
