<?php

namespace App\Filament\Resources\OrderResource\Widgets;

use App\Models\Order;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Number;

class OrderStats extends BaseWidget
{
    protected function getViewData(): array 
    {
        return array_merge(parent::getViewData(), [
            'isHorizontal' => true, // Set this to true to display stats in a single row
            'stats' => $this->getStats(),
        ]);
    }

    protected function getStats(): array
    {
        return [
            Stat::make('New Orders', Order::query()->where('status', 'new')->count()),
            Stat::make('Total Orders', Order::query()->count()),
            Stat::make('Average Order', Number::currency(Order::query()->avg('grand_total'), 'BDT')),
            Stat::make('Total Sales', Number::currency(Order::query()->sum('grand_total'), 'BDT')),

        ];
    }
}
