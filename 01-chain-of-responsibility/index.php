<?php

class StudentRequest {
    public function __construct(public string $type) {}
}

abstract class Handler {
    protected ?Handler $next = null;

    public function setNext(Handler $handler): Handler {
        $this->next = $handler;
        return $handler;
    }

    public function handle(StudentRequest $request): void {
        if ($this->canHandle($request)) {
            echo static::class . ": Processing "
                . $request->type . "...<br>";
        } else {
            echo static::class . ": Cannot process request.<br>";

            if ($this->next) {
                $this->next->handle($request);
            } else {
                echo "No office can process this request.<br>";
            }
        }
    }

    abstract protected function canHandle(StudentRequest $request): bool;
}

class StudentAffairsHandler extends Handler {
    protected function canHandle(StudentRequest $request): bool {
        return $request->type === "Good Moral Certificate";
    }
}

class RegistrarHandler extends Handler {
    protected function canHandle(StudentRequest $request): bool {
        return in_array($request->type, [
            "Transcript of Records",
            "Certificate of Enrollment"
        ]);
    }
}

class FinanceHandler extends Handler {
    protected function canHandle(StudentRequest $request): bool {
        return $request->type === "Payment Concern";
    }
}

class ICTHandler extends Handler {
    protected function canHandle(StudentRequest $request): bool {
        return $request->type === "Student ID Concern";
    }
}

echo "<h2>Student Request Processing System</h2>";

$studentAffairs = new StudentAffairsHandler();
$registrar = new RegistrarHandler();
$finance = new FinanceHandler();
$ict = new ICTHandler();

$studentAffairs->setNext($registrar)
               ->setNext($finance)
               ->setNext($ict);

$request = new StudentRequest("Transcript of Records");

echo "Request: " . $request->type . "<br><br>";

$studentAffairs->handle($request);

?>