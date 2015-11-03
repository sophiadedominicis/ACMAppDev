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
public class Course {
    private String courseName;
    private String fieldOfStudy;
    private double numUnits;
    private int courseNumber;

//Construct a new instance of CourseSched. Should I do an arraylist somewhere here?
    public Course (String courseTitle, String fieldOfStudy, int courseNumber, double units) {
        this.courseName = courseTitle;
        this.fieldOfStudy = fieldOfStudy;
        this.numUnits = units;
        this.courseNumber = courseNumber;
    }

    //Instance methods for the class CourseSched:

    //Return course title for course entry
    public String getCourseTitle(){
        return courseName;
    }

    public String getField(){
        return fieldOfStudy;
    }

    //Return number of course units for course entry
    public double getUnits(){
        return numUnits;
    }

    public int getCourseNumber(){
        return courseNumber;
    }

    public boolean equals(Course other){
        return courseName.equals(other.courseName) && fieldOfStudy.equals(other.fieldOfStudy) && numUnits==other.numUnits;
    }
}
