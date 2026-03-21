<?php

namespace App\Livewire\Charts;

use Livewire\Component;
use App\Models\Student;

class YearlyEnrollmentChart extends Component
{
    public $chartLabels = [];
    public $chartData = [];
    public $forecastLabels = [];
    public $forecastData = [];

    public function mount()
    {
        // --- Base yearly enrollment data ---
        $enrollments = Student::selectRaw('enrollment_year, COUNT(*) as total')
            ->whereNotNull('enrollment_year')
            ->groupBy('enrollment_year')
            ->orderBy('enrollment_year')
            ->get();

        $this->chartLabels = $enrollments->pluck('enrollment_year')->toArray();
        $this->chartData = $enrollments->pluck('total')->toArray();

        // --- Predictor-based adjustments ---
        $predictors = Student::selectRaw("
                enrollment_year,
                SUM(CASE WHEN sex = 'Male' THEN 1 ELSE 0 END) as males,
                SUM(CASE WHEN sex = 'Female' THEN 1 ELSE 0 END) as females,
                SUM(CASE WHEN is_4ps::text = '1' OR is_4ps::text = 'true' THEN 1 ELSE 0 END) as four_ps,
                AVG(age::integer) as avg_age
            ")
            ->whereNotNull('enrollment_year')
            ->groupBy('enrollment_year')
            ->orderBy('enrollment_year')
            ->get()
            ->keyBy('enrollment_year');

        // --- Simple Forecast (Linear Growth + Predictor Weighting) ---
        if (count($this->chartData) > 1) {
            $totalGrowth = 0;
            for ($i = 1; $i < count($this->chartData); $i++) {
                $totalGrowth += ($this->chartData[$i] - $this->chartData[$i - 1]);
            }

            $avgGrowth = $totalGrowth / (count($this->chartData) - 1);

            $lastYear = end($this->chartLabels);
            $lastValue = end($this->chartData);

            // Predictor weighting
            $predictorFactor = 1.0;
            if (isset($predictors[$lastYear])) {
                $row = $predictors[$lastYear];

                // more 4Ps students → higher likelihood of increase
                $predictorFactor += ($row->four_ps / max($lastValue, 1)) * 0.1;

                // gender balance → stable growth
                $genderDiff = abs($row->males - $row->females);
                $predictorFactor -= ($genderDiff / max($lastValue, 1)) * 0.05;

                // younger avg age → sustained enrollment
                if ($row->avg_age && $row->avg_age < 15) {
                    $predictorFactor += 0.05;
                }
            }

            $nextYear = $lastYear + 1;
            $forecastValue = $lastValue + ($avgGrowth * $predictorFactor);

            $this->forecastLabels = array_merge($this->chartLabels, [$nextYear]);
            $this->forecastData = array_merge($this->chartData, [round($forecastValue)]);
        } else {
            $this->forecastLabels = $this->chartLabels;
            $this->forecastData = $this->chartData;
        }
    }

    public function render()
    {
        return view('livewire.charts.yearly-enrollment-chart');
    }
}
