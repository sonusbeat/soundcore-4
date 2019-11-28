@extends('templates.admin')
@section('page_title', 'Single')

@section('content')
<div class="card mb-3">
    <div class="row no-gutters">
        <div class="col-md-5 mb-4">
            <img class="img-fluid" src="{{ asset('/images/singles/'.$single->image) }}" alt="{{ $single->title }}" title="{{ $single->title }}">
        </div>
        <div class="col-md-7">
            <div class="card-body">
                <h2 class="card-title">{{ $single->title }}</h2>
                <table class="table">
                    <tr>
                        <th>Permalink:</th>
                        <td>{{ $single->permalink }}</td>
                    </tr>
                    <tr>
                        <th>Feat:</th>
                        <td>{{ $single->feat }}</td>
                    </tr>
                    <tr>
                        <th>Version:</th>
                        <td>{{ $single->version }}</td>
                    </tr>
                    <tr>
                        <th>Genre</th>
                        <td>{{ $single->genre }}</td>
                    </tr>
                    <tr>
                        <th>Catalog</th>
                        <td>{{ $single->catalog }}</td>
                    </tr>
                    <tr>
                        <th>UPC</th>
                        <td>{{ $single->upc }}</td>
                    </tr>
                    <tr>
                        <th>ISRC:</th>
                        <td>{{ $single->isrc }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <div class="row no-gutters pl-4 pr-4">
        <div class="col">
            <h2>SEO</h2>
            <table class="table">
                <tr>
                    <th>Meta Title</th>
                    <th>{{ $single->meta_title }}</th>
                </tr>
                <tr>
                    <th>Meta Robots</th>
                    <th>{{ $single->meta_robots }}</th>
                </tr>
                <tr>
                    <th>Meta Description</th>
                    <th>{{ $single->meta_description }}</th>
                </tr>
            </table>
        </div><!-- /.col -->
        <div class="col">
            <h2>Stores</h2>
            <table class="table">
                <tr>
                    <th>Beatport</th>
                    <th>{{ $single->beatport }}</th>
                </tr>
                <tr>
                    <th>Itunes</th>
                    <th>{{ $single->itunes }}</th>
                </tr>
                <tr>
                    <th>Spotify</th>
                    <th>{{ $single->spotify }}</th>
                </tr>
                <tr>
                    <th>Deezer</th>
                    <th>{{ $single->deezer }}</th>
                </tr>
                <tr>
                    <th>Soundcloud</th>
                    <th>{{ $single->soundcloud }}</th>
                </tr>
                <tr>
                    <th>Youtube</th>
                    <th>{{ $single->youtube }}</th>
                </tr>
            </table>
        </div><!-- /.col -->
    </div><!-- /.row -->

    <div class="row mb-4 ml-4">
        <div class="col-md-6">
            <h2>Description</h2>
            {!! $single->description !!}
        </div><!-- /.col -->
        <div class="col-md-6">
            <h2>Dates</h2>

            <table class="table">
                <tr>
                    <th>Created At</th>
                    <td>{{ $single->created_at }}</td>
                </tr>
                <tr>
                    <th>Updated At</th>
                    <td>{{ $single->updated_at }}</td>
                </tr>
                <tr>
                    <th>Released At:</th>
                    <td>{{ $single->released_at }}</td>
                </tr>
            </table>
        </div><!-- /.col -->
    </div><!-- /.row -->

</div><!-- /.card -->
<a href="{{ route('admin.singles.index') }}" class="btn btn-primary">Back</a>
@endsection
