<?php
interface Command
{
    public function execute(): void;
    public function undo(): void;
}

class StudentSystem
{
    private bool $enrolled = false;
    private bool $subjectDropped = false;
    private bool $loggedIn = true;

    public function enrollStudent(): void
    {
        $this->enrolled = true;
        echo "Student successfully enrolled.<br>";
    }

    public function undoEnrollment(): void
    {
        $this->enrolled = false;
        echo "Enrollment undone.<br>";
    }

    public function dropSubject(): void
    {
        if (!$this->enrolled) {
            echo "Cannot drop a subject: student is not enrolled.<br>";
            return;
        }

        $this->subjectDropped = true;
        echo "Subject successfully dropped.<br>";
    }

    public function restoreSubject(): void
    {
        $this->subjectDropped = false;
        echo "Subject drop undone.<br>";
    }

    public function printRegistration(): void
    {
        echo "Registration: ";
        echo $this->enrolled ? "Enrolled" : "Not enrolled";
        echo $this->subjectDropped ? " (subject dropped)" : " (no subject dropped)";
        echo "<br>";
    }

    public function logout(): void
    {
        $this->loggedIn = false;
        echo "Student successfully logged out.<br>";
    }

    public function login(): void
    {
        $this->loggedIn = true;
        echo "Login restored.<br>";
    }
}

class EnrollCommand implements Command
{
    private StudentSystem $system;

    public function __construct(StudentSystem $system)
    {
        $this->system = $system;
    }

    public function execute(): void
    {
        $this->system->enrollStudent();
    }

    public function undo(): void
    {
        $this->system->undoEnrollment();
    }
}

class DropSubjectCommand implements Command
{
    private StudentSystem $system;

    public function __construct(StudentSystem $system)
    {
        $this->system = $system;
    }

    public function execute(): void
    {
        $this->system->dropSubject();
    }

    public function undo(): void
    {
        $this->system->restoreSubject();
    }
}

class PrintRegistrationCommand implements Command
{
    private StudentSystem $system;

    public function __construct(StudentSystem $system)
    {
        $this->system = $system;
    }

    public function execute(): void
    {
        $this->system->printRegistration();
    }

    public function undo(): void
    {

    }
}

class LogoutCommand implements Command
{
    private StudentSystem $system;

    public function __construct(StudentSystem $system)
    {
        $this->system = $system;
    }

    public function execute(): void
    {
        $this->system->logout();
    }

    public function undo(): void
    {
        $this->system->login();
    }
}

class CommandInvoker
{
    private array $history = [];

    public function executeCommand(Command $command): void
    {
        $command->execute();
        $this->history[] = $command;
    }

    public function undoLastCommand(): void
    {
        if (empty($this->history)) {
            echo "Nothing to undo.<br>";
            return;
        }

        $command = array_pop($this->history);
        $command->undo();
    }
}
