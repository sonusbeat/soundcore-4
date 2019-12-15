@extends('templates.admin')

@section('content')
<div class="row">
    <div class="col-4">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Last Published Singles</div>
                <div class="card-body">
                    <ul>
                        @foreach($singles as $single)
                        <li>
                            <a href="{{ route('admin.singles.show', $single->id) }}">
                                {{ $single->title }}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <!-- .card  -->
    </div>
    <div class="col-4">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Last Published Albums</div>
                <div class="card-body">
                    @if($albums->count())
                    <ul>
                        @foreach($albums as $album)
                        <li>
                            <a href="{{ route('admin.albums.show', $album->id) }}">
                                {{ $album->name }}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                    @else
                    <div class="alert alert-orange font-weight-bold text-center">There Aren't Albums Yet !</div>
                    @endif
                </div>
            </div>
        </div>
        <!-- .card  -->
    </div>
    <div class="col-4">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Last 5 something</div>
                <div class="card-body">
                    <ul>
                        <li>lorem lipsum dolor dolem</li>
                        <li>lorem lipsum dolor dolem</li>
                        <li>lorem lipsum dolor dolem</li>
                        <li>lorem lipsum dolor dolem</li>
                        <li>lorem lipsum dolor dolem</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- .card  -->
    </div>
</div>

@endsection
