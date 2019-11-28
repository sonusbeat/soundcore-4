@extends('templates.admin')
@section('page_title', 'Edit Single')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="card-title">Edit Single</div>
        </div>

        <form action="{{ route('admin.singles.update', $single) }}" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="_method" value="PATCH">
            @include('admin.singles._form')
        </form>
    </div><!-- .card  -->
@endsection
