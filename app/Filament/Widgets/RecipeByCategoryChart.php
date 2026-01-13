<?php

namespace App\Filament\Widgets;

use App\Models\Category;
use Filament\Widgets\ChartWidget;

class RecipeByCategoryChart extends ChartWidget
{
    protected static ?string $heading = 'Distribusi Resep per Kategori';

    protected static ?int $sort = 2;

    // Membuat widget mengambil lebar penuh secara grid
    protected int | string | array $columnSpan = 'full';

    // Menentukan tinggi maksimal canvas agar tidak terlalu besar saat span full
    protected static ?string $maxHeight = '300px';

    protected function getData(): array
    {
        $data = Category::withCount('recipes')->get();

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Resep',
                    'data' => $data->pluck('recipes_count')->toArray(),
                    'backgroundColor' => [
                        '#ea580c', // Orange Delicacy
                        '#fbbf24',
                        '#10b981',
                        '#3b82f6',
                        '#a855f7',
                    ],
                    // Mengecilkan ketebalan doughnut agar lebih elegan
                    'cutout' => '70%',
                ],
            ],
            'labels' => $data->pluck('name')->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }

    /**
     * Mengatur opsi Chart.js agar ukuran tetap terkendali
     */
    protected function getOptions(): array
    {
        return [
            'plugins' => [
                'legend' => [
                    'display' => true,
                    'position' => 'right', // Posisi legend di samping agar hemat ruang vertikal
                ],
            ],
            'maintainAspectRatio' => false, // Memungkinkan maxHeight bekerja
            'radius' => '80%', // Mengecilkan radius lingkaran di dalam kontainer
        ];
    }
}