<?php
require_once __DIR__ . '/classes.php';

echo "<h2>Grade Notification System - Observer Pattern</h2>";

$gradeSystem = new GradeSystem();

$gradeSystem->attach(new StudentPortal());
$gradeSystem->attach(new EmailNotification());
$gradeSystem->attach(new ParentNotification());

$gradeSystem->updateGrade(1.75);
