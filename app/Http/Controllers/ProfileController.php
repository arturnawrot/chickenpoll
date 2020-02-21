<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;

class ProfileController extends Controller
{
    private $profile;

    function __construct(Profile $profile)
    {
        $this->profile = $profile;
    }

    public function show($id)
    {
        return view('profile.index', ['profile' => $this->profile->find($id)]);
    }
}
