<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SiteSetting;

class SiteSettingController extends Controller
{
    public function edit()
    {
        $head = SiteSetting::Where('name', 'head')->exists() ?
            SiteSetting::Where('name', 'head')->first()->value : '';

        return view('admin.settings.edit', ['settings' => [
            'head' => $head
        ]]);
    }

    public function update(Request $request)
    {
        $value = $request->value == null ? " " : $request->value;

        SiteSetting::Where('name', 'head')->update(['name'=>$request->name, 'value'=>$value]);

        return redirect()->back()->with('alert-success', 'Success!');
    }
}
