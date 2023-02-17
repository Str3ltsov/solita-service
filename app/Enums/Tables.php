<?php

namespace App\Enums;

enum Tables: string
{
    case Products = 'products';
    case Orders = 'orders';
    case Users = 'users';
    case Categories = 'categories';
}
