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
                <div class="card-title">Last 5 Something</div>
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
