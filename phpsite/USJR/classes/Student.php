<?php
class Student {
    private $name;
    private $classScheduleNumber;

    public function __construct($name, $classScheduleNumber) {
        $this->name = $name;
        $this->classScheduleNumber = $classScheduleNumber;
    }

    public function getName() {
        return $this->name;
    }

    public function getClassScheduleNumber() {
        return $this->classScheduleNumber;
    }
}
