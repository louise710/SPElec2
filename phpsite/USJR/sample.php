<?php
class Discipline {
    private $name;
    private $lectures;
    private $exercises;

    public function __construct($name, $lectures, $exercises) {
        $this->name = $name;
        $this->lectures = $lectures;
        $this->exercises = $exercises;
    }

    public function getName() {
        return $this->name;
    }

    public function getLectures() {
        return $this->lectures;
    }

    public function getExercises() {
        return $this->exercises;
    }
}

class Teacher {
    private $name;
    private $title;

    public function __construct($name, $title) {
        $this->name = $name;
        $this->title = $title;
    }

    public function getName() {
        return $this->name;
    }

    public function getTitle() {
        return $this->title;
    }
}

class Student {
    private $name;
    private $id;

    public function __construct($name, $id) {
        $this->name = $name;
        $this->id = $id;
    }

    public function getName() {
        return $this->name;
    }

    public function getId() {
        return $this->id;
    }
}

class ClassSchedule {
    private $identifier;
    private $disciplines = [];
    private $teachers = [];
    private $students = [];

    public function __construct($identifier) {
        $this->identifier = $identifier;
    }

    public function addDiscipline($discipline) {
        $this->disciplines[] = $discipline;
    }

    public function addTeacher($teacher) {
        $this->teachers[] = $teacher;
    }

    public function addStudent($student) {
        $this->students[] = $student;
    }

    public function getIdentifier() {
        return $this->identifier;
    }

    public function getDisciplines() {
        return $this->disciplines;
    }

    public function getTeachers() {
        return $this->teachers;
    }

    public function getStudents() {
        return $this->students;
    }
}

class School {
    private $name;
    private $classSchedules = [];

    public function __construct($name) {
        $this->name = $name;
    }

    public function addClassSchedule($schedule) {
        $this->classSchedules[] = $schedule;
    }

    public function getName() {
        return $this->name;
    }

    public function getClassSchedules() {
        return $this->classSchedules;
    }
}

class University {
    public static function test() {
        $math = new Discipline('Mathematics', 20, 10);
        $science = new Discipline('Science', 18, 12);

        $teacher1 = new Teacher('Dr. Gregg Gabison', 'Dr.');
        $teacher2 = new Teacher('Ms. Marisa Mahilum', 'Ms.');
        $teacher3 = new Teacher('Mr. Roderick Bandalan', 'Mr.');

        $student1 = new Student('Clint Abastas', 1);
        $student2 = new Student('James Bunac', 2);
        $student3 = new Student('Eugene Cabatingan', 3);
        $student4 = new Student('Jullene Jane Evangelista', 4);
        $student5 = new Student('Jeoffrey Gudio', 5);
        $student6 = new Student('Richard Moreno', 6);
        $student7 = new Student('Jeffrey Rebutazo', 7);
        $student8 = new Student('Roy Salares', 8);
        $student9 = new Student('Resty Artiaga', 9);
        $student10 = new Student('Donnah Marizh Chan', 10);
        $student11 = new Student('Mikee Libato', 11);
        $student12 = new Student('John Pagador', 12);
        $student13 = new Student('Justine Panorel', 13);
        $student14 = new Student('Jerald Patalinghug', 14);
        $student15 = new Student('Pach Valenzona', 15);

        // Create class schedules
        $classSchedule1 = new ClassSchedule('ITELEC1A');
        $classSchedule1->addDiscipline($math);
        $classSchedule1->addDiscipline($science);
        $classSchedule1->addTeacher($teacher1);
        $classSchedule1->addTeacher($teacher2);
        $classSchedule1->addStudent($student1);
        $classSchedule1->addStudent($student2);
        $classSchedule1->addStudent($student3);
        $classSchedule1->addStudent($student4);
        $classSchedule1->addStudent($student5);
        $classSchedule1->addStudent($student6);
        $classSchedule1->addStudent($student7);
        $classSchedule1->addStudent($student8);

        $classSchedule2 = new ClassSchedule('ITELECIA');
        $classSchedule2->addDiscipline($math);
        $classSchedule2->addDiscipline($science);
        $classSchedule2->addTeacher($teacher3);
        $classSchedule2->addStudent($student9);
        $classSchedule2->addStudent($student10);
        $classSchedule2->addStudent($student11);
        $classSchedule2->addStudent($student12);
        $classSchedule2->addStudent($student13);
        $classSchedule2->addStudent($student14);
        $classSchedule2->addStudent($student15);

        // Create school
        $school = new School('University of San - Recoletos');
        $school->addClassSchedule($classSchedule1);
        $school->addClassSchedule($classSchedule2);

        // Display information
        echo "University of San - Recoletos\n";
        foreach ($school->getClassSchedules() as $schedule) {
            echo $schedule->getIdentifier() . " 10:00am-11:30am\nTeachers:\n";
            foreach ($schedule->getTeachers() as $teacher) {
                echo $teacher->getTitle() . " " . $teacher->getName() . "\n";
            }
            echo "Students:\n";
            foreach ($schedule->getStudents() as $student) {
                echo $student->getName() . "\n";
            }
        }
    }
}

// Run the test
University::test();
?>
