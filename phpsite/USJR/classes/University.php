<?php
// use classes\ClassSchedule;
class University {
    public static function test() {
        $discipline1 = new Discipline('ITELEC1A', 10, 5);
        $discipline2 = new Discipline('ITELECIA', 8, 6);

        $teacher1 = new Teacher('Dr. Gregg Gabison', 'Dr.');
        $teacher2 = new Teacher('Ms. Marisa Mahilum', 'Ms.');
        $teacher3 = new Teacher('Mr. Roderick Bandalan', 'Mr.');

        $student1 = new Student('Clint Abastas', 'ITELEC1A');
        $student2 = new Student('James Bunac', 'ITELEC1A');
        $student3 = new Student('Eugene Cabatingan', 'ITELEC1A');
        $student4 = new Student('Resty Artiaga', 'ITELECIA');

        $classSchedule1 = new ClassSchedule('ITELEC1A', '10:00am-11:30am');
        $classSchedule1->addTeacher($teacher1);
        $classSchedule1->addTeacher($teacher2);
        $classSchedule1->addStudent($student1);
        $classSchedule1->addStudent($student2);
        $classSchedule1->addStudent($student3);
        $classSchedule1->addDiscipline($discipline1);

        $classSchedule2 = new ClassSchedule('ITELECIA', '8:30am-10:00am');
        $classSchedule2->addTeacher($teacher3);
        $classSchedule2->addStudent($student4);
        $classSchedule2->addDiscipline($discipline2);

        $school = new School('University of San - Recoletos');
        $school->addClassSchedule($classSchedule1);
        $school->addClassSchedule($classSchedule2);

        echo $school->getName() . "\n";
        $scheduleNum = 1;
        foreach ($school->getClassSchedules() as $schedule) {
            echo $scheduleNum . " " . $schedule->getIdentifier() . " " . $schedule->getTime() . "\n";
            echo "Teachers:\n";
            foreach ($schedule->getTeachers() as $teacher) {
                echo $teacher->getTitle() . " " . $teacher->getName() . "\n";
            }
            foreach ($schedule->getStudents() as $student) {
                echo $student->getName() . "\n";
            }
            $scheduleNum++;
        }
    }
}
