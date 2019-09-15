<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;

class ProfileController extends Controller
{
    public function index(Profile $profile)
    {
        return view('profile.index', compact('profile', $profile));
    }
}
