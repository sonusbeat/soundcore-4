@extends('templates.admin')
@section('page_title', 'User Profile')

@section('content')
<div class="card mb-3">
    <div class="row no-gutters">
        <div class="col-md-5">
            <img class="img-fluid" src="{{ asset('/images/users/'.$user->image) }}" alt="{{ $user->full_name() }}" title="{{ $user->full_name() }}">
        </div>
        <div class="col-md-7">
            <div class="card-body">
                <h2 class="card-title">{{ $user->full_name() }}</h2>
                <table class="table">
                    <tr>
                        <th>Username:</th>
                        <td>{{ $user->username }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{ $user->email }}</td>
                    </tr>
                    <tr>
                        <th>Type</th>
                        <td>{{ $user->type == 'admin' ? 'Administrator' : 'Guest' }}</td>
                    </tr>
                    <tr>
                        <th>Active</th>
                        <td><i class="fas fa-{{ $user->active ? 'check text-success' : 'times text-danger' }}"></i></td>
                    </tr>
                    <tr>
                        <th>Created At</th>
                        <td>{{ $user->created_at }}</td>
                    </tr>
                    <tr>
                        <th>Updated At</th>
                        <td>{{ $user->updated_at }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
