@extends('layouts.admin')

@section('content')
<div class="col-lg-6 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Stats</h4>
            <table class="table table-striped table-condensed">
                <tr>
                    <td>Total visits:</td>
                    <td>{{ $data['stats']['total'] }}</td>
                </tr>
                <tr>
                    <td>Total unique visits:</td>
                    <td>{{ $data['stats']['unique'] }}</td>
                </tr>
            </table>
        </div>
    </div>
</div>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Visitors</h4>
                <p class="card-description"> Add class <code>.table-striped</code>
                </p>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>IP</th>
                            <th>method</th>
                            <th>url</th>
                            <th>referer</th>
                            <th>type</th>
                            <th>is_bot</th>
                            <th>os</th>
                            <th>browser</th>
                            <th>country</th>
                            <th>city</th>
                            <th>language</th>
                            <th>@sortablelink('created_at')</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($data['visitors'] as $visitor)
                                <tr>
                                    <td> {{ $visitor->ip }} </td>
                                    <td> {{ $visitor->method }} </td>
                                    <td> {{ $visitor->url }} </td>
                                    <td> {{ $visitor->referer }} </td>
                                    <td> {{ $visitor->type }} </td>
                                    <td> {{ $visitor->is_bot }} </td>
                                    <td> {{ $visitor->os }} </td>
                                    <td> {{ $visitor->browser }} </td>
                                    <td> {{ $visitor->country }} </td>
                                    <td> {{ $visitor->city }} </td>
                                    <td> {{ $visitor->language }} </td>
                                    <td> {{ $visitor->created_at }} </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {!! $data['visitors']->appends(\Request::except('page'))->render() !!}
            </div>
        </div>
    </div>
@endsection
