<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RedirectController extends Controller
{
    public function index()
    {
        // @TODO
        // I'm a little bit lazy today :P
        $url = "https://www.purevpn.com?aff=42096&a_bid=87d239e7";
        header("Location: $url");
    }
}
