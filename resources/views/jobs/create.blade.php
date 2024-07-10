@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h2>Post a Job</h2>
            <form action="{{ route('jobs.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="title">Title:</label>
                    <input type="text" name="title" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea name="description" class="form-control" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Post Job</button>
            </form>
        </div>
    </div>
</div>
@endsection
