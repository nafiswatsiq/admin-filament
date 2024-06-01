<?php

namespace App\Models;

use Filament\Forms\Set;
use Filament\Support\RawJs;
use Illuminate\Support\Str;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Barang extends Model
{
    use HasFactory;

    protected $fillable = ['kategori_barang_id', 'nama', 'slug', 'deskripsi', 'harga', 'berat', 'stok', 'gambar'];

    public function kategoriBarang()
    {
        return $this->belongsTo(KategoriBarang::class);
    }

    public static function getForm()
    {
        return [
            Select::make('kategori_barang_id')
                 ->searchable()
                 ->preload()
                 ->createOptionForm(KategoriBarang::getForm())
                 ->relationship('kategoriBarang', 'nama')
                 ->label('Kategori Barang')
                 ->columnSpanFull()
                 ->required(),
             TextInput::make('nama')
                 ->live(true)
                 ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state)))
                 ->label('Nama')
                 ->required(),
             TextInput::make('slug')
                 ->label('Slug')
                 ->readOnly(),
             TextInput::make('harga')
                 ->label('Harga')
                 ->prefix('Rp')
                 ->numeric()
                 ->mask(RawJs::make('$money($input)'))
                 ->stripCharacters(',')
                 ->required(),
             TextInput::make('berat')
                 ->label('Berat')
                 ->prefixIcon('heroicon-o-scale')
                 ->numeric()
                 ->mask(RawJs::make('$money($input)'))
                 ->stripCharacters(',')
                 ->required(),
             TextInput::make('stok')
                 ->label('Stok')
                 ->numeric()
                 ->mask(RawJs::make('$money($input)'))
                 ->stripCharacters(',')
                 ->columnSpanFull()
                 ->required(),
             Textarea::make('deskripsi')
                 ->label('Deskripsi')
                 ->columnSpanFull()
                 ->required(),
             FileUpload::make('gambar')
                 ->image()
                 ->imageEditor()
                 ->imageEditorAspectRatios([
                     null,
                     '16:9',
                     '4:3',
                     '1:1',
                     ])
                 ->directory('images')
                 ->label('Gambar')
                 ->columnSpanFull()
                 ->required(),
        ];
    }
}
