<?php
interface Observer
{
    public function update(string $message): void;
}

interface Subject
{
    public function attach(Observer $observer): void;
    public function detach(Observer $observer): void;
    public function notify(string $message): void;
}

class GradeSystem implements Subject
{
    private array $observers = [];

    public function attach(Observer $observer): void
    {
        $this->observers[] = $observer;
    }

    public function detach(Observer $observer): void
    {
        foreach ($this->observers as $key => $existingObserver) {
            if ($existingObserver === $observer) {
                unset($this->observers[$key]);
            }
        }
    }

    public function notify(string $message): void
    {
        foreach ($this->observers as $observer) {
            $observer->update($message);
        }
    }

    public function updateGrade(float $grade): void
    {
        echo "<strong>Grade updated: " . number_format($grade, 2) . "</strong><br><br>";
        $this->notify("A new grade has been posted.");
    }
}

class StudentPortal implements Observer
{
    public function update(string $message): void
    {
        echo "<strong>Student Portal:</strong><br>";
        echo htmlspecialchars($message) . "<br><br>";
    }
}

class EmailNotification implements Observer
{
    public function update(string $message): void
    {
        echo "<strong>Email Notification:</strong><br>";
        echo "Your grade has been updated.<br><br>";
    }
}

class ParentNotification implements Observer
{
    public function update(string $message): void
    {
        echo "<strong>Parent Notification:</strong><br>";
        echo "Student grade has been posted.<br><br>";
    }
}
