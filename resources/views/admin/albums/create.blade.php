@extends('templates.admin')
@section('page_title', 'Create Album')

@section('content')
<div class="card">
    <div class="card-header">
        <div class="card-title">Create Album</div>
    </div>

    <form action="{{ route('admin.albums.store') }}" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        @include('admin.albums._form')
    </form>
</div>
<!-- .card  -->
@endsection
