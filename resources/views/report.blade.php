@extends('layouts.app')
<?php
$url = route('polls.show', $id);
$title = "Report a poll ($url)";
?>
@section('title', $title)
@section('description', 'Real-time, instant, ad-free and simple')
@section('content')

                    <form method="POST" action="{{ route('report.store', $id) }}">
                            @csrf()
                          <div class="py-3 options" id="options">
                              <div class="form-group">
                                  <label for="content">Content</label>
                                  <textarea name="content" class="form-control" id="Title" rows="3" placeholder="Please, provide more details..."></textarea>
                                </div>
                              <div class="form-group">
                                  <label for="question1">Email</label>
                                  <input name="email" class="form-control" id="question1" placeholder="Email">
                                </div>
                          </div>
                          <div class="d-inline-block mt-4">
                              <button type="submit" class="btn btn-lg btn-primary">Create</button>
                          </div>
                  </form>
@endsection
