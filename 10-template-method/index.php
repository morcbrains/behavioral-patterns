<?php

abstract class Report {

    public final function generateReport(): void {
        $this->generateHeader();
        $this->retrieveData();
        $this->formatData();
        $this->generateFooter();
    }

    protected function generateHeader(): void {
        echo "========================<br>";
        echo strtoupper($this->getTitle()) . "<br>";
        echo "========================<br>";
    }

    abstract protected function getTitle(): string;
    abstract protected function retrieveData(): void;
    abstract protected function formatData(): void;

    protected function generateFooter(): void {
        echo "========================<br>";
        echo "END OF REPORT<br>";
        echo "========================<br>";
    }
}

class StudentReport extends Report {
    protected function getTitle(): string {
        return "Student Report";
    }

    protected function retrieveData(): void {
        echo "Student ID: 2026-001<br>";
        echo "Name: Juan Dela Cruz<br>";
        echo "Program: BSIT<br>";
    }

    protected function formatData(): void {
        echo "Student information successfully formatted.<br>";
    }
}

class GradeReport extends Report {
    protected function getTitle(): string {
        return "Grade Report";
    }

    protected function retrieveData(): void {
        echo "Student: Juan Dela Cruz<br>";
        echo "Subject: Programming<br>";
        echo "Grade: 1.75<br>";
    }

    protected function formatData(): void {
        echo "Grade information successfully formatted.<br>";
    }
}

class EnrollmentReport extends Report {
    protected function getTitle(): string {
        return "Enrollment Report";
    }

    protected function retrieveData(): void {
        echo "Student ID: 2026-001<br>";
        echo "Program: BSIT<br>";
        echo "Status: Enrolled<br>";
    }

    protected function formatData(): void {
        echo "Enrollment information successfully formatted.<br>";
    }
}

echo "<h2>Student Report Generation</h2>";

$studentReport = new StudentReport();
$studentReport->generateReport();

echo "<br>";

$gradeReport = new GradeReport();
$gradeReport->generateReport();

echo "<br>";

$enrollmentReport = new EnrollmentReport();
$enrollmentReport->generateReport();

?>