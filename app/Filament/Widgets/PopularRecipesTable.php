<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\RecipeResource;
use App\Models\Recipe;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class PopularRecipesTable extends BaseWidget
{
    // Mengatur urutan agar tampil di bawah grafik
    protected static ?int $sort = 3;

    // Mengambil lebar penuh halaman dashboard
    protected int | string | array $columnSpan = 'full';

    protected static ?string $heading = 'Resep Terpopuler (Rating Tertinggi)';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                // Mengambil resep dan menghitung rata-rata rating dari tabel comments
                Recipe::query()
                    ->withAvg('comments', 'rating')
                    ->orderByDesc('comments_avg_rating')
                    ->limit(5)
            )
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label('Foto')
                    ->circular(),

                Tables\Columns\TextColumn::make('title')
                    ->label('Nama Resep')
                    ->weight('bold'),

                Tables\Columns\TextColumn::make('category.name')
                    ->label('Kategori')
                    ->badge()
                    ->color('orange'),

                Tables\Columns\TextColumn::make('comments_avg_rating')
                    ->label('Rating')
                    ->numeric(decimalPlaces: 1)
                    ->icon('heroicon-m-star')
                    ->color('warning')
                    ->alignCenter(),

                Tables\Columns\TextColumn::make('comments_count')
                    ->label('Total Ulasan')
                    ->counts('comments')
                    ->alignCenter(),
            ])
            ->actions([
                Tables\Actions\Action::make('view')
                    ->label('Buka Resep')
                    ->url(fn (Recipe $record): string => RecipeResource::getUrl('edit', ['record' => $record]))
                    ->icon('heroicon-m-eye')
                    ->button(),
            ]);
    }
}
