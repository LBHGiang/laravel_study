<?php

namespace App\Constants;

class Permission
{
    const PRODUCT_LIST = 'products.list';
    const PRODUCT_DETAIL = 'products.detail';
    const PRODUCT_CREATE = 'products.create';


    public static function getAdminPermissions(): array
    {
        return [
            static::PRODUCT_LIST,
            static::PRODUCT_DETAIL,
            static::PRODUCT_CREATE,
        ];
    }

    public static function getUserPermissions(): array
    {
        return [

            static::PRODUCT_LIST,
            static::PRODUCT_DETAIL,
        ];
    }

    /**
     * For permissions seeding
     *
     * @return array
     */
    public static function getAllPermissions(): array
    {
        return [
            static::PRODUCT_LIST,
            static::PRODUCT_DETAIL,
            static::PRODUCT_CREATE,
        ];
    }
}
