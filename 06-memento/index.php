<?php

class StudentProfileMemento {
    public function __construct(
        private array $state
    ) {}

    public function getState(): array {
        return $this->state;
    }
}

class StudentProfile {
    private string $name;
    private string $program;
    private int $year;
    private string $email;

    public function __construct(
        string $name,
        string $program,
        int $year,
        string $email
    ) {
        $this->name = $name;
        $this->program = $program;
        $this->year = $year;
        $this->email = $email;
    }

    public function save(): StudentProfileMemento {
        return new StudentProfileMemento([
            "name" => $this->name,
            "program" => $this->program,
            "year" => $this->year,
            "email" => $this->email
        ]);
    }

    public function restore(StudentProfileMemento $memento): void {
        $state = $memento->getState();

        $this->name = $state["name"];
        $this->program = $state["program"];
        $this->year = $state["year"];
        $this->email = $state["email"];
    }

    public function updateProfile(
        string $program,
        int $year
    ): void {
        $this->program = $program;
        $this->year = $year;
    }

    public function display(): void {
        echo "Name: " . $this->name . "<br>";
        echo "Program: " . $this->program . "<br>";
        echo "Year: " . $this->year . "<br>";
        echo "Email: " . $this->email . "<br>";
    }
}

class ProfileHistory {
    private array $history = [];

    public function save(StudentProfileMemento $memento): void {
        $this->history[] = $memento;
    }

    public function undo(): ?StudentProfileMemento {
        return array_pop($this->history);
    }
}

echo "<h2>Student Profile Undo System</h2>";

$profile = new StudentProfile(
    "Juan Dela Cruz",
    "BSIT",
    3,
    "juan@example.com"
);

$history = new ProfileHistory();

echo "<b>Original Profile:</b><br>";
$profile->display();

$history->save($profile->save());

$profile->updateProfile("BSCS", 4);

echo "<br><b>Current Profile:</b><br>";
$profile->display();

echo "<br>Undo...<br><br>";

$memento = $history->undo();

if ($memento !== null) {
    $profile->restore($memento);
}

echo "<b>Restored Profile:</b><br>";
$profile->display();

?>