<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;
use App\StudentsList;
use App\Student;

class StudentsListTest extends TestCase
{
    public function testAddAndCount()
    {
        $student = new Student();
        $studentsList = new StudentsList();
        $studentsList -> add($student);
        $this -> assertSame(1, $studentsList -> count());
    }

    public function testGet()
    {
        $student = new Student();
        $studentsList = new StudentsList();
        $student -> setName("Max") -> setLastName("Guryanov") -> setFaculty("FMiIT") -> setCourse(4) -> setGroup(402);
        $studentsList -> add($student);
        $this -> assertInstanceOf(Student::class, $studentsList -> get(1));
    }

    public function testStore()
    {
        $student = new Student();
        $studentsList = new StudentsList();
        $student -> setName("Max") -> setLastName("Guryanov") -> setFaculty("FMiIT")-> setCourse(4) -> setGroup(402);
        $studentsList -> add($student);
        $this -> assertSame(null, $studentsList -> store("output"));
    }

    public function testLoad()
    {
        $studentsList = new StudentsList();
        $studentsList -> load("output");
        $this -> assertSame(1, $studentsList -> count());
        $this -> assertInstanceOf(Student::class, $studentsList -> get(1));
        $this -> assertSame("Файл fileName не существует!", $studentsList -> load("fileName"));
    }

    public function testCurrentAndKey()
    {
        $student1 = new Student();
        $student2 = new Student();
        $student3 = new Student();
        $studentsList = new StudentsList();
        $student1 -> setName("Max") -> setLastName("Guryanov") -> setFaculty("FMiIT")-> setCourse(4) -> setGroup(402);
        $student2 -> setName("Anton") -> setLastName("Pupkin") -> setFaculty("UF") -> setCourse(1) -> setGroup(102);
        $student3 -> setName("Kara") -> setLastName("Deliven") -> setFaculty("EF") -> setCourse(3) -> setGroup(305);
        $studentsList -> add($student1);
        $studentsList -> add($student2);
        $studentsList -> add($student3);

        $this -> assertSame("Id: 6" . "\n" .
        "Фамилия: Guryanov" . "\n" .
        "Имя: Max" . "\n" .
        "Факультет: FMiIT" . "\n" .
        "Курс: 4" . "\n" .
        "Группа: 402", $studentsList -> current() -> __toString());
        $this -> assertSame(6, $studentsList -> key());
        return $studentsList;
    }
}