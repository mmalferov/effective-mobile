<?php

declare(strict_types=1);

namespace App\Enums;

enum TaskStatus: string
{
    case PENDING = 'pending';
    case IN_PROGRESS = 'in_progress';
    case COMPLETED = 'completed';
    case CANCELLED = 'cancelled';
    case ARCHIVE = 'archive';

    public static function values(): array
    {
        return array_map(static fn(TaskStatus $enum) => $enum->value, self::cases());
    }

    public static function asString(): string
    {
        return implode(', ', self::values());
    }
}
