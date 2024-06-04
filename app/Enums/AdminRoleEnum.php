<?php

namespace App\Enums;
use App\Traits\EnumToArray;

enum AdminRoleEnum: string {
    use EnumToArray;
    case ADMIN = "0";
    case SUPER_ADMIN = "1";

    public static function getRoleName(int $role_id): string {
        if($role_id == AdminRoleEnum::ADMIN->value) {
            return "Admin";
        } else if($role_id == AdminRoleEnum::SUPER_ADMIN->value) {
            return "Super Admin";
        } else {
            return "Unknown";
        }
    }
}
