@if($sitesettings->where('name', 'head')->exists())
    {!! $sitesettings->where('name', 'head')->first()->value !!}
@endif
