@extends('layouts.admin')

@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Polls</h4>
                <p class="card-description"> Add class <code>.table-striped</code>
                </p>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>@sortablelink('title')</th>
                        <th>@sortablelink('votes_count', 'votes')</th>
                        <th>@sortablelink('reports_count', 'reports')</th>
                        <th>@sortablelink('created_at')</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($polls as $poll)
                            <tr>
                                <td> <a href="{{ route('polls.show', $poll->id) }}" target="_blank" rel="noopener noreferrer">{{ $poll->title }}</a> </td>
                                <td> {{ $poll->votes_count }} </td>
                                <td> {{ $poll->reports_count }} </td>
                                <td> {{ $poll->created_at }} </td>
                                <td><a href="{{ route('admin.polls.edit', $poll->id) }}" class="btn btn-warning btn-fw">Edit</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $polls->appends(\Request::except('page'))->render() !!}
            </div>
        </div>
    </div>
@endsection
