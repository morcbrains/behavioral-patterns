<?php
class Student
{
    private string $studentId;
    private string $name;

    public function __construct(string $studentId, string $name)
    {
        $this->studentId = $studentId;
        $this->name = $name;
    }

    public function getStudentId(): string
    {
        return $this->studentId;
    }

    public function getName(): string
    {
        return $this->name;
    }
}

class StudentIterator implements Iterator
{
    private array $students;
    private int $position = 0;

    public function __construct(array $students)
    {
        $this->students = $students;
    }

    public function current(): mixed
    {
        return $this->students[$this->position];
    }

    public function key(): mixed
    {
        return $this->position;
    }

    public function next(): void
    {
        $this->position++;
    }

    public function rewind(): void
    {
        $this->position = 0;
    }

    public function valid(): bool
    {
        return isset($this->students[$this->position]);
    }
}

class StudentCollection implements IteratorAggregate
{
    private array $students = [];

    public function add(Student $student): void
    {
        $this->students[] = $student;
    }

    public function getIterator(): Traversable
    {
        return new StudentIterator($this->students);
    }
}
