<?php
require_once __DIR__ . '/classes.php';

echo "<h2>Grade Calculation System - Strategy Pattern</h2>";

$simpleGrades = [88, 89, 88, 89];
$calculator = new GradeCalculator(new SimpleAverageStrategy());

echo "<strong>Strategy: Simple Average</strong><br>";
echo "Result: " . number_format($calculator->calculateGrade($simpleGrades), 2) . "<br><br>";

$weightedGrades = [
    ['score' => 90, 'weight' => 0.25],
    ['score' => 90, 'weight' => 0.25],
    ['score' => 92.5, 'weight' => 0.50]
];

$calculator->setStrategy(new WeightedAverageStrategy());

echo "<strong>Strategy: Weighted Average</strong><br>";
echo "Result: " . number_format($calculator->calculateGrade($weightedGrades), 2) . "<br>";
