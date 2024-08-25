<?php

namespace App\Filament\Widgets;

use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Student;
use App\Models\FeePayment;
use App\Models\StudentAccount;

class FeePaymentOverview extends BaseWidget
{
    protected static ?int $sort = 2;

    protected function getStats(): array
    {
        return [
            //all payments
            Stat::make('Total Fee Collected', FeePayment::sum('amount'))
            -> description('All Fee Collected')
            -> descriptionIcon('heroicon-o-arrow-right')
            ->icon('heroicon-o-banknotes')
            ->color('success')
            ->chart([
                '4','5','3','7','9','6','8'
            ]),

            //payments made this month
            Stat::make('This Month\'s Collection', 
                FeePayment::whereMonth('created_at', Carbon::now()->month)
                                    ->sum('amount'))
            -> description('Fee Collected this month')
            -> descriptionIcon('heroicon-o-arrow-right')
            ->icon('heroicon-o-banknotes')
            ->color('success'),

            //Fee Balances
            Stat::make('School Fees Account Balance', 
                StudentAccount::sum('balance'))
            -> description('Fees Account Balance')
            -> descriptionIcon('heroicon-o-arrow-right')
            ->icon('heroicon-o-banknotes')
            ->color('warning')
            ->chart([
                '4','5','3','7','9','6','8'
            ]),
        ];
    }

    //private function
}
