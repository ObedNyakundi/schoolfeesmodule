<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;

class SchoolExpenses extends ChartWidget
{
    protected static ?string $heading = 'School Expenses for the Year ';
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
}
