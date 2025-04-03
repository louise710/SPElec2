<?php
// namespace classes;
class ClassSchedule {
    private $identifier;
    private $time;
    private $students = [];
    private $teachers = [];
    private $disciplines = [];

    public function __construct($identifier, $time) {
        $this->identifier = $identifier;
        $this->time = $time;
    }

    public function addStudent(Student $student) {
        $this->students[] = $student;
    }

    public function addTeacher(Teacher $teacher) {
        $this->teachers[] = $teacher;
    }

    public function addDiscipline(Discipline $discipline) {
        $this->disciplines[] = $discipline;
    }

    public function getIdentifier() {
        return $this->identifier;
    }

    public function getTime() {
        return $this->time;
    }

    public function getStudents() {
        return $this->students;
    }

    public function getTeachers() {
        return $this->teachers;
    }

    public function getDisciplines() {
        return $this->disciplines;
    }
}
