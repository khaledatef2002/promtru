<?php

namespace App\Enum;

enum ContactStatus: string
{
    case PENDING = 'PENDING';
    case ACCEPTED = 'ACCEPTED';
    case DECLINED = 'DECLINED';

    public static function all(): array
    {
        return [
            self::PENDING->value,
            self::ACCEPTED->value,
            self::DECLINED->value,
        ];
    }
}
