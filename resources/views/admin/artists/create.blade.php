@extends('templates.admin')
@section('page_title', 'Create Artist')

@section('content')
<div class="card">
    <div class="card-header">
        <div class="card-title">Create Artist</div>
    </div>

    <form action="{{ route('admin.artists.store') }}" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        @include('admin.artists._form')
    </form>
</div>
<!-- .card  -->
@endsection
