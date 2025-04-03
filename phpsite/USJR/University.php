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
        $student5 = new Student('Jullene Jane Evangelista', 'ITELEC1A');
        $student6 = new Student('Jeoffrey Gudio', 'ITELEC1A');
        $student7 = new Student('Richard Moreno', 'ITELEC1A');
        $student8 = new Student('Jeffrey Rebutazo', 'ITELEC1A');
        $student9 = new Student('Roy Salares', 'ITELEC1A');
        $student10 = new Student('Donnah Marizh Chan', 'ITELECIA');
        $student11 = new Student('Mikee Libato', 'ITELECIA');
        $student12 = new Student('John Pagador', 'ITELECIA');
        $student13 = new Student('Justine Panorel', 'ITELECIA');
        $student14 = new Student('Jerald Patalinghug', 'ITELECIA');
        $student15 = new Student('Pach Valenzona', 'ITELECIA');

        $classSchedule1 = new ClassSchedule('ITELEC1A', '10:00am-11:30am');
        $classSchedule1->addTeacher($teacher1);
        $classSchedule1->addTeacher($teacher2);
        $classSchedule1->addStudent($student1);
        $classSchedule1->addStudent($student2);
        $classSchedule1->addStudent($student3);
        $classSchedule1->addStudent($student5);
        $classSchedule1->addStudent($student6);
        $classSchedule1->addStudent($student7);
        $classSchedule1->addStudent($student8);
        $classSchedule1->addStudent($student9);
        $classSchedule1->addDiscipline($discipline1);

        $classSchedule2 = new ClassSchedule('ITELECIA', '8:30am-10:00am');
        $classSchedule2->addTeacher($teacher3);
        $classSchedule2->addStudent($student4);
        $classSchedule2->addStudent($student10);
        $classSchedule2->addStudent($student11);
        $classSchedule2->addStudent($student12);
        $classSchedule2->addStudent($student13);
        $classSchedule2->addStudent($student14);
        $classSchedule2->addStudent($student15);
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

            echo "Students:\n";
            $students = $schedule->getStudents();
            $studentNames = array_map(function($student) {
                return $student->getName();
            }, $students);
            echo implode(" ", $studentNames) . "\n";

            $scheduleNum++;
        }
    }
}
