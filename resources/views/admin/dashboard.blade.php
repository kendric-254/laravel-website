@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Admin Dashboard</h1>
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <form action="{{ route('admin.updateSystem') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-primary">Update System</button>
    </form>
</div>
@endsection
