<?php

function phone_formatter(string $phone)
{
    $phone = str_replace('-', '', $phone);

    if (strlen($phone) === 10) {
        $phone = substr($phone, 0, 2) . '-' . substr($phone, 2, 4) . '-' . substr($phone, 6);
    } elseif (strlen($phone) === 9) {
        $phone = substr($phone, 0, 2) . '-' . substr($phone, 2, 3) . '-' . substr($phone, 5);
    }

    return $phone;
}
