<?php


namespace App\Enums;

//enum that holds user types
enum UserType: string
{
    case NORMAL = 'normal';
    case SILVER = 'silver';
    case GOLD = 'gold';


    public static function values(): array //return enum array key and values
    {

        return array_column(self::cases(), 'name', 'value');
    }

}
