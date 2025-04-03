<?php
class School {
    private $name;
    private $classSchedules = [];

    public function __construct($name) {
        $this->name = $name;
    }

    public function addClassSchedule(ClassSchedule $classSchedule) {
        $this->classSchedules[] = $classSchedule;
    }

    public function getName() {
        return $this->name;
    }

    public function getClassSchedules() {
        return $this->classSchedules;
    }
}
