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

        $body_top = SiteSetting::Where('name', 'body_top')->exists() ?
            SiteSetting::Where('name', 'body_top')->first()->value : '';

        $body_right = SiteSetting::Where('name', 'body_right')->exists() ?
            SiteSetting::Where('name', 'body_right')->first()->value : '';

        return view('admin.settings.edit', ['settings' => [
            'head' => $head,
            'body_top' => $body_top,
            'body_right' => $body_right
        ]]);
    }

    public function update(Request $request)
    {
        $value = $request->value == null ? " " : $request->value;

        $setting = SiteSetting::Where('name', $request->name);

        if($setting->exists()) {
            $setting->update(['name'=>$request->name, 'value'=>$value]);
        } else {
            $setting->create(['name'=>$request->name, 'value'=>$value]);
        }

        return redirect()->back()->with('alert-success', 'Success!');
    }
}
