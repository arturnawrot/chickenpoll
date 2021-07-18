<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DevEnvironmentController extends Controller
{
    public function showPhpInfo()
    {
        return phpinfo();
    }
}
