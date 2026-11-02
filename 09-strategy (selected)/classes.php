<?php
interface GradeStrategy
{
    public function calculate(array $grades): float;
}

class SimpleAverageStrategy implements GradeStrategy
{
    public function calculate(array $grades): float
    {
        if (count($grades) === 0) {
            return 0.0;
        }

        return array_sum($grades) / count($grades);
    }
}

class WeightedAverageStrategy implements GradeStrategy
{
    public function calculate(array $grades): float
    {
        $total = 0.0;
        $totalWeight = 0.0;

        foreach ($grades as $grade) {
            $total += $grade['score'] * $grade['weight'];
            $totalWeight += $grade['weight'];
        }

        if ($totalWeight <= 0) {
            return 0.0;
        }

        return $total / $totalWeight;
    }
}

class GradeCalculator
{
    private GradeStrategy $strategy;

    public function __construct(GradeStrategy $strategy)
    {
        $this->strategy = $strategy;
    }

    public function setStrategy(GradeStrategy $strategy): void
    {
        $this->strategy = $strategy;
    }

    public function calculateGrade(array $grades): float
    {
        return $this->strategy->calculate($grades);
    }
}
