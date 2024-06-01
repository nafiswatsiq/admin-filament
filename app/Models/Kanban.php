<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

class Kanban extends Model implements Sortable
{
    use HasFactory, SortableTrait;

    protected $fillable = ['title', 'description', 'status', 'position'];

    public $sortable = [
        'order_column_name' => 'position',
        'sort_when_creating' => true,
    ];
}
