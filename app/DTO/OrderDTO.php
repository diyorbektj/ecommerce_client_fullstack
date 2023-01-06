<?php

namespace App\DTO;

class OrderDTO
{
    public static function toArray($product, $user)
    {
        return [
            'user_name' => $user->name,
            'user_phone' => '+992987722178',
            'user_id' => $user->id,
            'status' => 'pending',
            'total' => 10,
        ];
    }
}
