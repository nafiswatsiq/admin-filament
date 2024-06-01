<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DataScanResource\Pages;
use App\Models\DataScan;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class DataScanResource extends Resource
{
    protected static ?string $model = DataScan::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // ScannerBarang::make('data')
                TextInput::make('data')
                    ->label('Data')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('data')
                    ->label('Data')
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDataScans::route('/'),
            'create' => Pages\CreateDataScan::route('/create'),
            'edit' => Pages\EditDataScan::route('/{record}/edit'),
            'scan' => Pages\Scan::route('/scan'),
        ];
    }
}
