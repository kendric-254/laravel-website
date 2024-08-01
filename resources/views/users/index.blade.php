@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Users Management</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-success mb-2" href="{{ route('users.create') }}"><i class="fa fa-plus"></i> Create New User</a>
        </div>
    </div>
</div>

@session('success')
    <div class="alert alert-success" role="alert"> 
        {{ $value }}
    </div>
@endsession

<table class="table table-bordered">
   <tr>
       <th>No</th>
       <th>Name</th>
       <th>Email</th>
       <th>Roles</th>
       <th width="380px">Action</th>
   </tr>
   @foreach ($data as $key => $user)
   <tr>
       <td>{{ ++$i }}</td>
       <td>{{ $user->name }}</td>
       <td>{{ $user->email }}</td>
       <td>
           @if(!empty($user->getRoleNames()))
               @foreach($user->getRoleNames() as $v)
                   <label class="badge bg-success">{{ $v }}</label>
               @endforeach
           @endif
       </td>
       <td>
           <!-- Show button -->
           <a class="btn btn-info btn-sm" href="{{ route('users.show', $user->id) }}">
               <i class="fa-solid fa-list"></i> Show
           </a>

           <!-- Edit button -->
           <a class="btn btn-primary btn-sm" href="{{ route('users.edit', $user->id) }}">
               <i class="fa-solid fa-pen-to-square"></i> Edit
           </a>
           
           <!-- Deactivate button -->
           <form method="POST" action="{{ route('users.deactivate', $user->id) }}" style="display:inline">
               @csrf
               @method('PUT')
               <button type="submit" class="btn btn-warning btn-sm">
                   <i class="fa-solid fa-ban"></i> Deactivate
               </button>
           </form>

           <!-- Reactivate button, shown only if the user is inactive -->
           @if (!$user->active)
               <form method="POST" action="{{ route('users.reactivate', $user->id) }}" style="display:inline">
                   @csrf
                   {{-- Since the route expects a POST request, we use POST --}}
                   <button type="submit" class="btn btn-success btn-sm">
                       <i class="fa-solid fa-check"></i> Reactivate
                   </button>
               </form>
           @endif

           <!-- Delete button -->
           <form method="POST" action="{{ route('users.destroy', $user->id) }}" style="display:inline">
               @csrf
               @method('DELETE')
               <button type="submit" class="btn btn-danger btn-sm">
                   <i class="fa-solid fa-trash"></i> Delete
               </button>
           </form>
       </td>
   </tr>
@endforeach

</table>

{!! $data->links('pagination::bootstrap-5') !!}

<p class="text-center text-primary"><small>Glen's project all right reserved</small></p>
@endsection