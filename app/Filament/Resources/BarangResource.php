<?php

namespace App\Filament\Resources;

use App\Models\KategoriBarang;
use Filament\Tables;
use App\Models\Barang;
use Filament\Forms\Set;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Support\RawJs;
use Illuminate\Support\Str;
use Filament\Resources\Resource;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\BarangResource\Pages;
use BezhanSalleh\FilamentShield\Traits\HasPageShield;

class BarangResource extends Resource
{
    protected static ?string $model = Barang::class;

    protected static ?string $navigationGroup = 'Kelola Barang';

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationIcon = 'heroicon-o-inbox-stack';

    protected static ?string $navigationLabel = 'Barang';

    public static function form(Form $form): Form
    {
        return $form
            ->schema(Barang::getForm());
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama')
                    ->label('Nama')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('harga')
                    ->label('Harga')
                    ->money('IDR')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('stok')
                    ->label('Stok')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('berat')
                    ->label('Berat')
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                Filter::make('stok')
                    ->label('Stok Kurang dari 10')
                    ->query(fn (Builder $query): Builder => $query->where('stok', '<', 10)),
                SelectFilter::make('kategori_barang_id')
                    ->label('Kategori Barang')
                    ->relationship('kategoriBarang', 'nama')
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\ReplicateAction::make()
                    ->before(function ($record) {
                        $data = $record->replicate()->fill([
                            'slug' => Str::slug($record->slug . '-duplicate'),
                        ]);

                        return $data;
                    })
                    ->label('Duplicate')
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageBarangs::route('/'),
        ];
    }
}
