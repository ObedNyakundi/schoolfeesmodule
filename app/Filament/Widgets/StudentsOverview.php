<?php

namespace App\Filament\Widgets;

use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Student;

class StudentsOverview extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        return [

            //Students Widgets
            Stat::make('Total Students', Student::count())
            -> description('All Admitted Students')
            -> descriptionIcon('heroicon-o-arrow-trending-up')
            ->icon('heroicon-o-users')
            ->color('success')
            ->chart([
                '4','5','3','7','9','6','8'
            ]),

            Stat::make('Recently Admitted', 
                    Student::whereMonth('created_at', Carbon::now()->month)
                   ->get()
                   ->count())
            -> description('Admitted This Month')
            -> descriptionIcon('heroicon-o-arrow-right')
            ->icon('heroicon-o-clock')
            ->color('success'),

            Stat::make('Admissions per Class', Student::whereMonth('created_at', Carbon::now()->month)
                   ->distinct('stream_id')
                   ->count())
            -> description('Classes that Admitted This Month')
            -> descriptionIcon('heroicon-o-arrow-right')
            ->icon('heroicon-o-building-library')
            ->color('primary')
            ->chart([
                '5','5','7','7','5','5','4'
            ]),

        ];
    }
}
