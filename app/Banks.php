<?php

namespace App;

enum Banks: string
{
    case CommBank = 'commbank';
    case Amex = 'amex';
    case ING = 'ing';

    public static function list(): array
    {
        return array_map(fn($bank) => [
            'name' => $bank->name,
            'value' => $bank->value,
        ], self::cases());
    }

}
