<?php

namespace App\Models;

use Filament\Forms\Set;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KategoriBarang extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'slug'];

    public function barangs()
    {
        return $this->hasMany(Barang::class);
    }

    public static function getForm()
    {
        return [
            TextInput::make('nama')
                ->live(true)
                ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state)))
                ->label('Nama')
                ->required(),
            TextInput::make('slug')
                ->readOnly()
                ->label('Slug'),
        ];
    }
}
