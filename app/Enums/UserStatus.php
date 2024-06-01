<?php

namespace App\Enums;

use Mokhosh\FilamentKanban\Concerns\IsKanbanStatus;

enum UserStatus: string
{
    use IsKanbanStatus;

    case Todo = 'todo';
    case Active = 'active';
    case Done = 'done';
}
