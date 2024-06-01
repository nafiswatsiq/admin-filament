<?php

namespace App\Filament\Pages;

use App\Models\User;
use App\Models\Kanban;
use App\Enums\UserStatus;
use Filament\Actions\CreateAction;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Mokhosh\FilamentKanban\Pages\KanbanBoard;
use BezhanSalleh\FilamentShield\Traits\HasPageShield;

class UsersKanbanBoard extends KanbanBoard
{
    use HasPageShield;
    
    protected static string $model = Kanban::class;
    protected static string $statusEnum = UserStatus::class;

    protected static string $recordTitleAttribute = 'title';
    protected static string $recordDescriptionAttribute = 'description';
    protected static string $recordStatusAttribute = 'status';

    protected string $editModalTitle = 'Edit Record';

    protected string $editModalWidth = '2xl';

    protected string $editModalSaveButtonLabel = 'Save';

    protected string $editModalCancelButtonLabel = 'Cancel';

    protected static string $view = 'filament-kanban::kanban-board';

    protected static string $headerView = 'filament-kanban::kanban-header';

    protected static string $recordView = 'filament-kanban::kanban-record';

    protected static string $statusView = 'filament-kanban::kanban-status';

    protected static string $scriptsView = 'filament-kanban::kanban-scripts';

    protected static ?string $navigationLabel = 'Activity Board';

    protected ?string $heading = 'Activity Board';

    // public function onStatusChanged(int $recordId, string $status, array $fromOrderedIds, array $toOrderedIds): void
    // {
    //     Kanban::find($recordId)->update(['status' => $status]);
    //     Kanban::setNewOrder($toOrderedIds);
    // }

    // public function onSortChanged(int $recordId, string $status, array $orderedIds): void
    // {
    //     Kanban::setNewOrder($orderedIds);
    // }

    protected function getEditModalFormSchema(null|int $recordId): array
    {
        return [
            TextInput::make('title'),
            RichEditor::make('description'),
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make('Create New Record')
                ->label('Tambah Baru')
                ->model(Kanban::class)
                ->form(function () {
                    return [
                        TextInput::make('title')->rules('required'),
                        RichEditor::make('description'),
                    ];
                }),
        ];
    }
}
