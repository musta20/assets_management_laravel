<?php

declare(strict_types=1);

namespace App\Enums;


enum  UserRole  :string
{
     case ADMIN = 'Super Admin';
     case MANAGER = 'manager';
     case EMPLOYEE = 'employee';
     case TECHNICIAN = 'technician';


}


?>