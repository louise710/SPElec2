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
