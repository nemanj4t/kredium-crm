<?php

namespace App\Http\Enums;

enum LoanTypeEnum: string {
    case CASH = 'cash-loan';
    case HOME = 'home-loan';
}
