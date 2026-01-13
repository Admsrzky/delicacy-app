<?php

namespace App\Filament\Widgets;

use App\Models\Recipe;
use App\Models\Tip;
use App\Models\Comment;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Resep', Recipe::count())
            ->description('Resep yang terbit di website')
            ->descriptionIcon('heroicon-m-beaker')
            ->chart([7, 2, 10, 3, 15, 4, 17]) // Contoh data tren
            ->color('success'),

        Stat::make('Tips Memasak', Tip::count())
            ->description('Artikel tips aktif')
            ->descriptionIcon('heroicon-m-light-bulb')
            ->chart([2, 4, 6, 8, 4, 10, 12])
            ->color('warning'),

        Stat::make('Komentar Masuk', Comment::count())
            ->description('Ulasan dari komunitas')
            ->descriptionIcon('heroicon-m-chat-bubble-left-right')
            ->chart([15, 4, 10, 2, 12, 4, 11])
            ->color('primary'),

        Stat::make('Rata-rata Rating', number_format(Comment::avg('rating'), 1) . ' / 5.0')
            ->description('Kepuasan pengguna')
            ->descriptionIcon('heroicon-m-star')
            ->color('orange'),
        ];
    }
}