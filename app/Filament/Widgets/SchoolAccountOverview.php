<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\SchoolAccount;

class SchoolAccountOverview extends BaseWidget
{
    protected static ?int $sort = 3;

    protected function getStats(): array
    {

        return [
            //Current account balance
            Stat::make('School Account Balance', SchoolAccount::latest() -> first() -> balance)
            -> description('Current Balance')
            -> descriptionIcon('heroicon-o-arrow-right')
            ->icon('heroicon-o-banknotes')
            ->color('success')
            ->chart([
                '7','4','5','3','5','7','4'
            ]),

            //all Expenses Amount
            Stat::make('School Expenses', SchoolAccount::latest() -> first() -> expenses)
            -> description('Current Balance')
            -> descriptionIcon('heroicon-o-arrow-right')
            ->icon('heroicon-o-banknotes')
            ->color('warning')
            ->chart([
                '7','4','5','3','5','7','4','5','3','5','7','4'
            ]),

            //all income Amount
            Stat::make('School Expenses', SchoolAccount::latest() -> first() -> income)
            -> description('Current Balance')
            -> descriptionIcon('heroicon-o-arrow-right')
            ->icon('heroicon-o-banknotes')
            ->color('primary')
            ->chart([
                '7','4','5','3','5','7','4','5','3','5','7','4'
            ]),

        ];
    }
}
