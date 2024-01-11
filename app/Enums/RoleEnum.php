<?php

namespace App\Enums;

enum RoleEnum: string
{
    case ADMIN = "admin";
    case AGENCY = "agency";
    case USER = "user";

    public function toPersian(): string
    {
        return match ($this){
            self::ADMIN=>"ادمین",
            self::AGENCY => "بنگاه دار",
            self::USER => "کاربر",
            default=>"aaa",
        };
    }
}
