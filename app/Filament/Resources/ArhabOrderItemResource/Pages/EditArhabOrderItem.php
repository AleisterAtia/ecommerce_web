<?php

namespace App\Filament\Resources\ArhabOrderItemResource\Pages;

use App\Filament\Resources\ArhabOrderItemResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditArhabOrderItem extends EditRecord
{
    protected static string $resource = ArhabOrderItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
