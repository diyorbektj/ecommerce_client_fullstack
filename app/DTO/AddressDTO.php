<?php

namespace App\DTO;

class AddressDTO
{
    public static function toArray(array $data)
    {
        return [
            'fullname' => $data['fullname'],
            'email' => $data['email'],
            'phone_number' => $data['phone_number'],
            'country' => $data['country'],
            'region' => $data['region'],
            'city' => $data['city'],
            'street' => $data['street'],
            'postcode' => $data['postcode'],
            'user_id' => auth('sanctum')->id(),
        ];
    }
}
