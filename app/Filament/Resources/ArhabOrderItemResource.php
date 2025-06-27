<?php

namespace App\Filament\Resources;

use Filament\Tables;
use Filament\Forms\Form;
use App\Models\OrderItem;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use App\Filament\Resources\OrdersResource;
use App\Filament\Resources\ArhabOrderItemResource\Pages;

// Import resource lain untuk membuat link

class ArhabOrderItemResource extends Resource
{
    protected static ?string $model = OrderItem::class;

    // Pengaturan Navigasi di Sidebar
    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';
    protected static ?string $navigationLabel = 'Order Items';
    protected static ?string $navigationGroup = 'Orders'; // Digrupkan bersama Orders
    protected static ?int $navigationSort = 2;

    /**
     * Form dikosongkan karena item tidak boleh dibuat atau diedit secara manual.
     */
    public static function form(Form $form): Form
    {
        return $form->schema([]);
    }

    /**
     * Tabel untuk menampilkan semua item dari semua pesanan.
     */
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // Kolom untuk nomor pesanan induk, dengan link ke halaman detail pesanan tersebut
                Tables\Columns\TextColumn::make('order.order_number')
                    ->label('Order Number')
                    ->searchable()
                    ->sortable()
                    ->url(fn($record) => OrdersResource::getUrl('edit', ['record' => $record->order_id])),

                // Kolom untuk nama produk
                Tables\Columns\TextColumn::make('product.name')
                    ->label('Product')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('quantity')
                    ->sortable(),

                Tables\Columns\TextColumn::make('price')
                    ->money('IDR')
                    ->sortable(),

                // Kolom untuk tanggal pesanan dibuat
                Tables\Columns\TextColumn::make('order.created_at')
                    ->label('Date Ordered')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                // Anda bisa menambahkan filter di sini jika perlu
            ])
            ->actions([
                // Tidak ada aksi edit atau delete
            ])
            ->bulkActions([
                // Tidak ada bulk action
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListArhabOrderItems::route('/'),
            // Hapus halaman create dan edit
        ];
    }

    /**
     * Fungsi ini memastikan tombol "Create" tidak muncul.
     */
    public static function canCreate(): bool
    {
        return false;
    }
}