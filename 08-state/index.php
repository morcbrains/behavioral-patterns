<?php

interface EnrollmentState {
    public function enroll(Student $student): void;
    public function getName(): string;
}

class ApplicantState implements EnrollmentState {
    public function enroll(Student $student): void {
        echo "Student must complete pre-assessment first.<br>";
    }

    public function getName(): string {
        return "Applicant";
    }
}

class PreAssessedState implements EnrollmentState {
    public function enroll(Student $student): void {
        echo "Student successfully enrolled.<br>";
        $student->setState(new EnrolledState());
    }

    public function getName(): string {
        return "Pre-Assessed";
    }
}

class EnrolledState implements EnrollmentState {
    public function enroll(Student $student): void {
        echo "Student is already enrolled.<br>";
    }

    public function getName(): string {
        return "Enrolled";
    }
}

class DroppedState implements EnrollmentState {
    public function enroll(Student $student): void {
        echo "Dropped student must apply for readmission.<br>";
    }

    public function getName(): string {
        return "Dropped";
    }
}

class GraduatedState implements EnrollmentState {
    public function enroll(Student $student): void {
        echo "Graduated students cannot enroll again.<br>";
    }

    public function getName(): string {
        return "Graduated";
    }
}

class Student {
    private EnrollmentState $state;

    public function __construct() {
        $this->state = new ApplicantState();
    }

    public function setState(EnrollmentState $state): void {
        $this->state = $state;
    }

    public function getState(): string {
        return $this->state->getName();
    }

    public function enroll(): void {
        $this->state->enroll($this);
    }
}

echo "<h2>Student Enrollment Status</h2>";

$student = new Student();

echo "Current State: " . $student->getState() . "<br>";
echo "Action: Enroll<br>";
echo "Result: ";
$student->enroll();

echo "<br>";

$student->setState(new PreAssessedState());

echo "Current State: " . $student->getState() . "<br>";
echo "Action: Enroll<br>";
echo "Result: ";
$student->enroll();

echo "<br>New State: " . $student->getState();

?>