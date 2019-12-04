@extends('templates.admin')
@section('page_title', 'Edit Album')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="card-title">Edit Album</div>
        </div>

        <form action="{{ route('admin.albums.update', $album) }}" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="_method" value="PATCH">
            @include('admin.albums._form')
        </form>
    </div><!-- .card  -->
@endsection
