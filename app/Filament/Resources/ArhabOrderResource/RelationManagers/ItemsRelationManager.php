<?php

namespace App\Filament\Resources\ArhabOrderResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class ItemsRelationManager extends RelationManager
{
    protected static string $relationship = 'items';

    /**
     * Kita tidak mendefinisikan form karena item pesanan tidak seharusnya 
     * dibuat atau diedit secara manual oleh admin untuk menjaga integritas data.
     * Mereka dibuat secara otomatis saat checkout.
     */
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                // Kosongkan atau hapus bagian ini
            ]);
    }

    /**
     * Konfigurasi tabel untuk menampilkan detail item yang dipesan.
     */
    public function table(Table $table): Table
    {
        return $table
            // Menghapus recordTitleAttribute karena kita akan menampilkan beberapa kolom
            ->columns([
                Tables\Columns\TextColumn::make('product.name') // <-- KUNCI: Mengakses 'name' dari relasi 'product' di model ArhabOrderItem
                    ->label('Product Name')
                    ->searchable(),

                Tables\Columns\TextColumn::make('quantity')
                    ->label('Quantity')
                    ->sortable(),

                Tables\Columns\TextColumn::make('price')
                    ->label('Price (at time of order)')
                    ->money('IDR') // <-- Memformat sebagai mata uang Rupiah
                    ->sortable(),
            ])
            ->filters([
                // Filter biasanya tidak diperlukan di sini
            ])
            ->headerActions([
                // Menghapus CreateAction karena item tidak dibuat manual dari sini
            ])
            ->actions([
                // Menghapus EditAction dan DeleteAction untuk mencegah perubahan pada pesanan yang sudah final
            ])
            ->bulkActions([
                // Menghapus BulkActionGroup
            ]);
    }
}