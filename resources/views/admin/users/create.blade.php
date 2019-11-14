@extends('templates.admin')
@section('page_title', 'Create User')

@section('content')
<div class="card">
    <div class="card-header">
        <div class="card-title">Create User</div>
    </div>

    <form action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        @include('admin.users._form')
    </form>
</div>
<!-- .card  -->
@endsection
