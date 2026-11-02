<?php

interface Mediator {
    public function sendMessage(string $message, Student $sender): void;
}

class ChatMediator implements Mediator {
    private array $students = [];

    public function addStudent(Student $student): void {
        $this->students[] = $student;
    }

    public function sendMessage(string $message, Student $sender): void {
        echo $sender->getName() . ": " . $message . "<br><br>";

        foreach ($this->students as $student) {
            if ($student !== $sender) {
                $student->receiveMessage($message, $sender->getName());
            }
        }
    }
}

class Student {
    public function __construct(
        private string $name,
        private Mediator $mediator
    ) {}

    public function getName(): string {
        return $this->name;
    }

    public function sendMessage(string $message): void {
        $this->mediator->sendMessage($message, $this);
    }

    public function receiveMessage(string $message, string $sender): void {
        echo $this->name . " receives:<br>";
        echo $sender . ": " . $message . "<br><br>";
    }
}

echo "<h2>Student Communication System</h2>";

$mediator = new ChatMediator();

$juan = new Student("Juan", $mediator);
$maria = new Student("Maria", $mediator);
$pedro = new Student("Pedro", $mediator);

$mediator->addStudent($juan);
$mediator->addStudent($maria);
$mediator->addStudent($pedro);

$juan->sendMessage("Hello everyone!");

?>