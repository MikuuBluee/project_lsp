<?php

namespace App\Filament\Resources\BookResource\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\book;

class BookStats extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Buku', book::count())
                ->color('primary')
                ->icon('heroicon-o-book-open'),
            //
        ];
    }
}
