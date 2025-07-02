<?php

namespace App\Filament\Widgets;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\ArhabOrder;
use App\Models\ArhabProduct;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        // Menghitung total pendapatan bulan ini
        $revenueThisMonth = Order::where('status', 'completed')
            ->whereMonth('created_at', Carbon::now()->month)
            ->sum('total_price');

        // Menghitung jumlah pesanan baru yang masih pending
        $newOrdersCount = Order::where('status', 'pending')->count();

        // Menghitung jumlah user dengan role 'customer'
        $customerCount = User::where('role', 'customer')->count();

        // Menghitung jumlah produk yang stoknya di bawah 10
        $lowStockCount = Product::where('stock', '<', 10)->count();

        return [
            Stat::make('Pendapatan (Bulan Ini)', 'Rp ' . number_format($revenueThisMonth, 0, ',', '.'))
                ->description('Total dari pesanan selesai')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),
            Stat::make('Pesanan Baru (Pending)', $newOrdersCount)
                ->description('Pesanan yang perlu diproses')
                ->descriptionIcon('heroicon-m-shopping-cart')
                ->color('warning'),
            Stat::make('Total Pelanggan', $customerCount)
                ->description('Jumlah customer terdaftar')
                ->descriptionIcon('heroicon-m-users')
                ->color('info'),
            Stat::make('Produk Stok Menipis', $lowStockCount)
                ->description('Produk dengan stok di bawah 10')
                ->descriptionIcon('heroicon-m-exclamation-triangle')
                ->color('danger'),
        ];
    }
}