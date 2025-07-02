<?php

namespace App\Filament\Widgets;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\ArhabOrder;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class OrdersChart extends ChartWidget
{
    protected static ?string $heading = 'Pesanan 14 Hari Terakhir';
    protected int|string|array $columnSpan = 'full';
    protected static ?string $maxHeight = '300px';

    protected function getData(): array
    {
        $data = Order::query()
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as count'))
            ->where('created_at', '>=', Carbon::now()->subDays(14))
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->pluck('count', 'date');

        $labels = [];
        for ($i = 0; $i < 14; $i++) {
            $date = Carbon::now()->subDays(13 - $i);
            $labels[] = $date->format('d M');
            $datasets[0]['data'][] = $data[$date->format('Y-m-d')] ?? 0;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Pesanan Dibuat',
                    'data' => $datasets[0]['data'],
                    'backgroundColor' => 'rgba(54, 162, 235, 0.2)',
                    'borderColor' => 'rgba(54, 162, 235, 1)',
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'line'; // Tipe grafik: line, bar, pie, dll.
    }
}