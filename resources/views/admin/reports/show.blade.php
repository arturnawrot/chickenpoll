@extends('layouts.admin')

@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('admin.reports.destroy') }}">
                    @csrf()
                    @method('delete')
                    @foreach($poll->reports as $report)
                            <input type="hidden" value="{{ $report->id }}" name="reports[]"></input>
                    @endforeach
                    <button class="btn btn-danger">Delete all reports</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                @foreach($poll->reports as $report)
                    <div class="mt-5 mb-5">
                        <h3>{{ $report->title }}</h3>
                        <p>{{ $report->content }}</p>
                        <p>{{ $report->email }}</p>
                        <p>{{ $report->created_at }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
