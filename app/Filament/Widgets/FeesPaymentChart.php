<?php

namespace App\Filament\Widgets;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Filament\Widgets\ChartWidget;
use App\Models\FeePayment;

class FeesPaymentChart extends ChartWidget
{
    protected static ?string $heading = 'Fee Collection For The Year';
    protected static ?int $sort = 3;
    protected static ?string $pollingInterval = '10s';
    //protected string | int | array $columnSpan = 'full';

    protected function getData(): array
    {
       
        $data = FeePayment::select(DB::raw('MONTH(created_at) as month'), DB::raw('SUM(amount) as total'))
            ->where('created_at', '>=', now()->subYears(1))
            ->groupBy('month')
            ->get()
            ->mapWithKeys(function ($item) {
                return [$item->month => $item->total];
            })->toArray();


        return [
            
            'datasets' => [
                [
                    'label' => 'Total Payments',
                    'data' => $data ,
                   /* 'backgroundColor'=> 
                    [
                          'rgb(255, 99, 132)',
                          'rgb(75, 192, 192)',
                          'rgb(255, 205, 86)',
                          'rgb(201, 203, 207)',
                          'rgb(54, 162, 235)'
                    ]*/
                ]
            ],
            
            'labels' => array_keys($data),

        ];
    }

    //fetch fee payments per month
    private function getFeePaymentsPerMonth(){
        $now = Carbon::now();
        
        $feePaymentsPerMonth=[];

        $months =collect(range(1, 12)) ->map(function($month) use ($now , $feePaymentsPerMonth){
           $count = FeePayment::whereMonth('created_at', Carbon::parse($now->month($month)-> format('Y-m')))->sum();
         });

    }

    //type of chart
    protected function getType(): string
    {
        return 'bar';
    }

    //chart description
    public function getDescription(): ?string
    {
        return 'The fee collected per month.';
    }
}
