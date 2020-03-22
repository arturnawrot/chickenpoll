@if($sitesettings->where('name', 'body_top')->exists())
    {!! $sitesettings->where('name', 'body_top')->first()->value !!}
@endif
