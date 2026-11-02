<?php
require_once __DIR__ . '/classes.php';

$students = new StudentCollection();
$students->add(new Student("2026-001", "Juan"));
$students->add(new Student("2026-002", "Maria"));
$students->add(new Student("2026-003", "Pedro"));

echo "<h2>Student Record Collection - Iterator Pattern</h2>";
echo "<strong>Student List</strong><br><br>";

foreach ($students as $student) {
    echo htmlspecialchars($student->getStudentId()) . " - ";
    echo htmlspecialchars($student->getName()) . "<br>";
}
