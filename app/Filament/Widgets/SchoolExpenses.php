<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;

class SchoolExpenses extends ChartWidget
{
    protected static ?string $heading =" School Expenses";
    protected static ?int $sort = 3;


    protected function getData(): array
    {
        return [
            //
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }

     //chart description
    public function getDescription(): ?string
    {
        return 'The School Expenses for the year ' . now()->year;
    }
}
