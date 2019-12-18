@extends('templates.admin')
@section('page_title', 'Album')

@section('content')
<div class="card mb-3">
    <div class="row no-gutters">
        <div class="col-md-5 mb-4">
            @if($album->coverart != '')
                <img class="img-fluid" src="/images/releases/albums/{{ $album->coverart }}-medium.jpg" alt="{{ $album->coverart_alt }}" title="{{ $album->coverart_alt }}">
            @else
                <img class="img-fluid" src="/images/no-image.jpg" alt="No Image Available" title="No Image Available">
            @endif
        </div>
        <div class="col-md-7">
            <div class="card-body">
                <h2 class="card-title">{{ $album->name }}</h2>
                <table class="table">
                    <tr>
                        <th>Artist</th>
                        <td>
                            <a href="{{ route('admin.artists.show', $album->artist->id) }}">
                                {{ $album->artist->artist_name }}
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <th>Permalink</th>
                        <td>{{ $album->permalink }}</td>
                    </tr>
                    <tr>
                        <th>Catalog</th>
                        <td>{{ $album->catalog }}</td>
                    </tr>
                    <tr>
                        <th>UPC</th>
                        <td>{{ $album->upc }}</td>
                    </tr>
                    <tr>
                        <th>ISRC</th>
                        <td>{{ $album->isrc }}</td>
                    </tr>
                    <tr>
                        <th>Tracks Quantity</th>
                        <td>{{ $album->tracks_quantity }}</td>
                    </tr>
                    <tr>
                        <th>Various Artists</th>
                        <td>{{ $album->various_artists ? 'Yes' : 'No' }}</td>
                    </tr>
                    <tr>
                        <th>Genre</th>
                        <td>{{ $album->genre }}</td>
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
                    <th>{{ $album->meta_title }}</th>
                </tr>
                <tr>
                    <th>Meta Robots</th>
                    <th>{{ $album->meta_robots }}</th>
                </tr>
                <tr>
                    <th>Meta Description</th>
                    <th>{{ $album->meta_description }}</th>
                </tr>
            </table>
        </div><!-- /.col -->
        <div class="col">
            <h2>Stores</h2>
            <table class="table">
                <tr>
                    <th>Beatport</th>
                    <th>{{ $album->beatport }}</th>
                </tr>
                <tr>
                    <th>Itunes</th>
                    <th>{{ $album->itunes }}</th>
                </tr>
                <tr>
                    <th>Spotify</th>
                    <th>{{ $album->spotify }}</th>
                </tr>
                <tr>
                    <th>Deezer</th>
                    <th>{{ $album->deezer }}</th>
                </tr>
                <tr>
                    <th>Soundcloud</th>
                    <th>{{ $album->soundcloud }}</th>
                </tr>
                <tr>
                    <th>Youtube</th>
                    <th>{{ $album->youtube }}</th>
                </tr>
            </table>
        </div><!-- /.col -->
    </div><!-- /.row -->

    <div class="row mb-4 ml-4">
        <div class="col-md-6">
            <h2>Description</h2>
            {!! $album->description !!}
        </div><!-- /.col -->
        <div class="col-md-6">
            <h2>Dates</h2>

            <table class="table">
                <tr>
                    <th>Created At</th>
                    <td>{{ $album->created_at }}</td>
                </tr>
                <tr>
                    <th>Updated At</th>
                    <td>{{ $album->updated_at }}</td>
                </tr>
                <tr>
                    <th>Released At</th>
                    <td>{{ $album->released_at }}</td>
                </tr>
            </table>
        </div><!-- /.col -->
    </div><!-- /.row -->

    @if($album->singles()->count())
    <div class="row ml-4">
        <div class="col">
            <h2>Songs</h2>
            <ol>
                @foreach($album->singles as $single)
                <li><a href="#">{{ $single->title }}</a></li>
                @endforeach
            </ol>
        </div>
    </div>
    @endif
</div><!-- /.card -->
<a href="{{ route('admin.albums.index') }}" class="btn btn-primary">Back</a>
@endsection
