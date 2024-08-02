@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Dashboard</h1>
    <div class="row">
        <div class="col">
            <h2>Products</h2>
            <p>Total: {{ $productCount }}</p>
            <ul>
                @foreach($recentProducts as $product)
                    <li>{{ $product->name }}</li>
                @endforeach
            </ul>
        </div>
        <div class="col">
            <h2>Roles</h2>
            <p>Total: {{ $roleCount }}</p>
            <ul>
                @foreach($recentRoles as $role)
                    <li>{{ $role->name }}</li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection
