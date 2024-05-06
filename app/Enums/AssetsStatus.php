<?php
namespace App\Enums;

enum AssetsStatus: string
{
    case in_use = 'in_use';
    case maintenance = 'maintenance';
    case disposed = 'disposed';
}



?>