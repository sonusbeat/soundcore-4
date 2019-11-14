@extends('templates.admin')
@section('page_title', 'Edit Artist')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="card-title">Edit Artist</div>
        </div>

        <form action="{{ route('admin.artists.update', $artist) }}" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="_method" value="PATCH">
            @include('admin.artists._form')
        </form>
    </div><!-- .card  -->
@endsection
