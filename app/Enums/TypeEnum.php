<?php

namespace App\Enums;

enum TypeEnum: string
{
    case RENT = "rent";
    case MORTGAGE = "mortgage";

    public function toPersian(): string
    {
        return match ($this){
            self::RENT=>"اجاره",
            self::MORTGAGE => "رهن",
            default=>"aaa",
        };
    }
}
