@extends('templates.admin')
@section('page_title', 'Create Stem')

@section('content')
<div class="card">
    <div class="card-header">
        <div class="card-title">Create Stem</div>
    </div>

    <form action="{{ route('admin.stems.store') }}" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        @include('admin.stems._form')
    </form>
</div>
<!-- .card  -->
@endsection
