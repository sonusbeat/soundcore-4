@extends('templates.admin')
@section('page_title', 'Edit Stem')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="card-title">Edit Stem</div>
        </div>

        <form action="{{ route('admin.stems.update', $stem) }}" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="_method" value="PATCH">
            @include('admin.stems._form')
        </form>
    </div><!-- .card  -->
@endsection
