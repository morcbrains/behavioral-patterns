<?php
require_once __DIR__ . '/classes.php';

$studentSystem = new StudentSystem();
$invoker = new CommandInvoker();

echo "<h2>Student Action System - Command Pattern</h2>";

echo "<strong>Executing: Enroll Student</strong><br>";
$invoker->executeCommand(new EnrollCommand($studentSystem));

echo "<br><strong>Executing: Drop Subject</strong><br>";
$invoker->executeCommand(new DropSubjectCommand($studentSystem));

echo "<br><strong>Undo Last Command</strong><br>";
$invoker->undoLastCommand();

echo "<br><strong>Executing: Print Registration</strong><br>";
$invoker->executeCommand(new PrintRegistrationCommand($studentSystem));

echo "<br><strong>Executing: Logout</strong><br>";
$invoker->executeCommand(new LogoutCommand($studentSystem));
