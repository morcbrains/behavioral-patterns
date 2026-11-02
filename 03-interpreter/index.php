<?php

interface Expression {
    public function interpret(array $student): bool;
}

class TerminalExpression implements Expression {
    private string $field;
    private mixed $value;

    public function __construct(string $field, mixed $value) {
        $this->field = strtolower($field);
        $this->value = $value;
    }

    public function interpret(array $student): bool {
        return isset($student[$this->field])
            && $student[$this->field] == $this->value;
    }
}

class AndExpression implements Expression {
    public function __construct(
        private Expression $left,
        private Expression $right
    ) {}

    public function interpret(array $student): bool {
        return $this->left->interpret($student)
            && $this->right->interpret($student);
    }
}

class OrExpression implements Expression {
    public function __construct(
        private Expression $left,
        private Expression $right
    ) {}

    public function interpret(array $student): bool {
        return $this->left->interpret($student)
            || $this->right->interpret($student);
    }
}

class StudentContext {
    public function __construct(private array $student) {}

    public function evaluate(Expression $expression): bool {
        return $expression->interpret($this->student);
    }
}

echo "<h2>Student Search/Query System</h2>";

$student = [
    "program" => "BSIT",
    "year" => 4
];

$context = new StudentContext($student);

$programBSIT = new TerminalExpression("PROGRAM", "BSIT");
$yearFour = new TerminalExpression("YEAR", 4);

$andQuery = new AndExpression($programBSIT, $yearFour);

echo "Expression: PROGRAM = \"BSIT\" AND YEAR = 4<br>";

$result = $context->evaluate($andQuery);

echo "Result: " . ($result ? "TRUE" : "FALSE") . "<br><br>";

$programBSCS = new TerminalExpression("PROGRAM", "BSCS");

$orQuery = new OrExpression($programBSIT, $programBSCS);

echo "Expression: PROGRAM = \"BSIT\" OR PROGRAM = \"BSCS\"<br>";

$result = $context->evaluate($orQuery);

echo "Result: " . ($result ? "TRUE" : "FALSE");

?>