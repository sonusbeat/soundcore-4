@extends('templates.admin')
@section('page_title', 'Create Single')

@section('content')
<div class="card">
    <div class="card-header">
        <div class="card-title">Create Single</div>
    </div>

    <form action="{{ route('admin.singles.store') }}" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        @include('admin.singles._form')
    </form>
</div>
<!-- .card  -->
@endsection
