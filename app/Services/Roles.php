<?php
namespace App\Services;

final class Roles {
    const ADMIN = \Delight\Auth\Role::ADMIN;
    const USER = \Delight\Auth\Role::AUTHOR;
    const BANNED = 2;
    const NORMAL = 0;

    public static function getRoles() {
        return [
            [
                "id" => self::USER,
                "title" => "Обычный пользователь"
            ],
            [
                "id" => self::ADMIN,
                "title" => "Администратор"
            ]
        ];
    }

    
    public static function getRole($key)
    {
        foreach(self::getRoles() as $role) {
            if($role['id'] == $key) {
                return $role['title'];
            }
        }
    }

    public static function getStatus($status) {
        if($status == Roles::BANNED) {
           return '<span class="btn btn-danger">Забанен</span>';
        } else if($status == Roles::NORMAL) {
           return '<span class="btn btn-success">Активный</span>';        
        }
    }
}