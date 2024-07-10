@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h2>Edit Job</h2>
            <form action="{{ route('jobs.update', $job->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="title">Title:</label>
                    <input type="text" name="title" class="form-control" value="{{ $job->title }}" required>
                </div>
                <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea name="description" class="form-control" required>{{ $job->description }}</textarea>
                </div>
                <button type="submit" class="btn btn-primary">Update Job</button>
            </form>
        </div>
    </div>
</div>
@endsection
