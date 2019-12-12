@extends('layouts.app')

@section('content')
<div class="container h-100">
    <div class="row align-items-center">
        <div class="w-100 mt-5 pt-5">
            <h1 class="text-center title">
              <span style="color:#404346;">Easy</span><span style="color:#ef145b;">Poll</span>
            </h1>
            <div class="mt-5 col-lg-10">
                  <h1 class="display">Create a new poll</h1>
                  <p class="lead">Real-time, instant, ad-free and simple</p>
                    <form>
                          <div class="py-3 options">
                              <div class="form-group">
                                  <label for="Title">Title</label>
                                  <textarea class="form-control" id="Title" rows="2" placeholder="What's your favorite song?"></textarea>
                                </div>
                              <div class="form-group">
                                  <label for="question1">Poll option</label>
                                  <input class="form-control" id="question1" placeholder="Enter option">
                                </div>
                                <div class="form-group">
                                    <label for="question1">Poll option</label>
                                    <input class="form-control" id="question1" placeholder="Enter option">
                                </div>
                          </div>
                          <div class="checkboxes ml-1">
                              <div class="form-check">
                                  <input type="checkbox" class="checkmark" id="exampleCheck1">
                                  <label class="form-check-label" for="exampleCheck1">Check me out</label>
                                </div>
                          </div>
                          <div class="d-inline-block mt-4">
                              <button type="submit" class="btn btn-lg btn-primary">Create</button>
                              <button type="submit" class="ml-3 btn btn-lg btn-primary">Save draft</button>
                          </div>
                  </form>
            </div>
        </div>
    </div>
</div>
@endsection