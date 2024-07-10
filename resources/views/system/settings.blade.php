@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>System Settings</h2>
        </div>
    </div>
</div>

@if (session('success'))
    <div class="alert alert-success" role="alert"> 
        {{ session('success') }}
    </div>
@endif

<form action="{{ route('system.settings.update') }}" method="POST">
    @csrf

    <div class="form-group">
        <label for="site_name">Site Name</label>
        <input type="text" name="site_name" class="form-control" value="{{ old('site_name', $settings['site_name']) }}" required>
    </div>

    <div class="form-group">
        <label for="maintenance_mode">Maintenance Mode</label>
        <select name="maintenance_mode" class="form-control" required>
            <option value="1" {{ old('maintenance_mode', $settings['maintenance_mode']) == 1 ? 'selected' : '' }}>Enabled</option>
            <option value="0" {{ old('maintenance_mode', $settings['maintenance_mode']) == 0 ? 'selected' : '' }}>Disabled</option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Update Settings</button>
</form>
@endsection
