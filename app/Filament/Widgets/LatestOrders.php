<?php

namespace App\Filament\Widgets;

use Filament\Tables;
use App\Models\Order;
use App\Models\ArhabOrder;
use Filament\Tables\Table;
use App\Filament\Resources\OrdersResource;
use App\Filament\Resources\ArhabOrderResource;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestOrders extends BaseWidget
{
    protected int|string|array $columnSpan = 'full'; // Agar widget ini memakan lebar penuh

    public function table(Table $table): Table
    {
        return $table
            ->query(
                // Mengambil 5 pesanan terakhir
                Order::query()->latest()->limit(5)
            )
            ->columns([
                Tables\Columns\TextColumn::make('order_number')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Customer')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'secondary' => 'pending',
                        'warning' => 'processing',
                        'success' => 'completed',
                        'danger' => 'cancelled',
                    ]),
                Tables\Columns\TextColumn::make('total_price')
                    ->money('IDR')
                    ->sortable(),
            ])
            ->actions([
                // Menambahkan tombol untuk langsung ke halaman edit order
                Tables\Actions\Action::make('View Order')
                    ->url(fn(Order $record): string => OrdersResource::getUrl('edit', ['record' => $record]))
                    ->icon('heroicon-m-eye'),
            ]);
    }
}