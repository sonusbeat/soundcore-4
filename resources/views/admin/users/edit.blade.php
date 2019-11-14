@extends('templates.admin')
@section('page_title', 'Edit User')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="card-title">Edit User</div>
        </div>

        <form action="{{ route('admin.users.update', $user) }}" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="_method" value="PATCH">
            @include('admin.users._form')
        </form>
    </div>
    <!-- .card  -->
@endsection
