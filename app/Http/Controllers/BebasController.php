<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BebasController extends Controller
{
    public function bebas() {
        phpinfo();
    }
}
