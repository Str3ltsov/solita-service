<?php

namespace App\Enums;

enum Tables: string
{
    case Products = 'products';
    case Orders = 'orders';
    case Users = 'users';
    case Returns = 'returns';
    case Carts = 'carts';
    case Categories = 'categories';
}