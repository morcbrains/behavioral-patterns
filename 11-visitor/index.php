<?php

interface Visitor {
    public function visitStudent(Student $student): void;
    public function visitFaculty(Faculty $faculty): void;
    public function visitAlumni(Alumni $alumni): void;
}

interface Element {
    public function accept(Visitor $visitor): void;
}

class Student implements Element {
    public function __construct(public string $name) {}

    public function accept(Visitor $visitor): void {
        $visitor->visitStudent($this);
    }
}

class Faculty implements Element {
    public function __construct(public string $name) {}

    public function accept(Visitor $visitor): void {
        $visitor->visitFaculty($this);
    }
}

class Alumni implements Element {
    public function __construct(public string $name) {}

    public function accept(Visitor $visitor): void {
        $visitor->visitAlumni($this);
    }
}

class CSVExportVisitor implements Visitor {
    public function visitStudent(Student $student): void {
        echo "Student exported: " . $student->name . "<br>";
    }

    public function visitFaculty(Faculty $faculty): void {
        echo "Faculty exported: " . $faculty->name . "<br>";
    }

    public function visitAlumni(Alumni $alumni): void {
        echo "Alumni exported: " . $alumni->name . "<br>";
    }
}

class ReportVisitor implements Visitor {
    public function visitStudent(Student $student): void {
        echo "Student Report: " . $student->name . "<br>";
    }

    public function visitFaculty(Faculty $faculty): void {
        echo "Faculty Report: " . $faculty->name . "<br>";
    }

    public function visitAlumni(Alumni $alumni): void {
        echo "Alumni Report: " . $alumni->name . "<br>";
    }
}

class StatisticsVisitor implements Visitor {
    public function visitStudent(Student $student): void {
        echo "Student Statistics calculated.<br>";
    }

    public function visitFaculty(Faculty $faculty): void {
        echo "Faculty Statistics calculated.<br>";
    }

    public function visitAlumni(Alumni $alumni): void {
        echo "Alumni Statistics calculated.<br>";
    }
}

// Additional visitor challenge
class PDFReportVisitor implements Visitor {
    public function visitStudent(Student $student): void {
        echo "PDF Student Report generated.<br>";
    }

    public function visitFaculty(Faculty $faculty): void {
        echo "PDF Faculty Report generated.<br>";
    }

    public function visitAlumni(Alumni $alumni): void {
        echo "PDF Alumni Report generated.<br>";
    }
}

echo "<h2>Student Record Operations</h2>";

$records = [
    new Student("Juan Dela Cruz"),
    new Faculty("Maria Santos"),
    new Alumni("Pedro Reyes")
];

echo "<h3>CSV Export Visitor</h3>";

$csvVisitor = new CSVExportVisitor();

foreach ($records as $record) {
    $record->accept($csvVisitor);
}

echo "<br><h3>Report Visitor</h3>";

$reportVisitor = new ReportVisitor();

foreach ($records as $record) {
    $record->accept($reportVisitor);
}

echo "<br><h3>Statistics Visitor</h3>";

$statisticsVisitor = new StatisticsVisitor();

foreach ($records as $record) {
    $record->accept($statisticsVisitor);
}

echo "<br><h3>PDF Report Visitor</h3>";

$pdfVisitor = new PDFReportVisitor();

foreach ($records as $record) {
    $record->accept($pdfVisitor);
}

?>