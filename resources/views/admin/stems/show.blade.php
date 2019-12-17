@extends('templates.admin')
@section('page_title', 'Stem')

@section('content')
<div class="card mb-3">
    <div class="row no-gutters">
        <div class="col-md-5 mb-4">
            @if($stem->coverart != '')
                <img class="img-fluid" src="/images/stems/{{ $stem->coverart }}-medium.jpg" alt="{{ $stem->coverart_alt }}" title="{{ $stem->coverart_alt }}">
            @else
                <img class="img-fluid" src="/images/no-image.jpg" alt="No Image Available" title="No Image Available">
            @endif
        </div>
        <div class="col-md-7">
            <div class="card-body">
                <h2 class="card-title">{{ $stem->title }}</h2>
                <table class="table">
                    <tr>
                        <th>Artist</th>
                        <td>
                            <a href="{{ route('admin.artists.show', $stem->artist->id) }}">
                                {{ $stem->artist->artist_name }}
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <th>Permalink</th>
                        <td>{{ $stem->permalink }}</td>
                    </tr>
                    <tr>
                        <th>Version</th>
                        <td>{{ $stem->version }}</td>
                    </tr>
                    <tr>
                        <th>Time</th>
                        <td>{{ $stem->time }}</td>
                    </tr>
                    <tr>
                        <th>Catalog</th>
                        <td>{{ $stem->catalog }}</td>
                    </tr>
                    <tr>
                        <th>UPC</th>
                        <td>{{ $stem->upc }}</td>
                    </tr>
                    <tr>
                        <th>ISRC</th>
                        <td>{{ $stem->isrc }}</td>
                    </tr>
                    <tr>
                        <th>Genre</th>
                        <td>{{ $stem->genre }}</td>
                    </tr>
                    <tr>
                        <th>Secondary Genre</th>
                        <td>{{ $stem->secondary_genre }}</td>
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
                    <th>{{ $stem->meta_title }}</th>
                </tr>
                <tr>
                    <th>Meta Robots</th>
                    <th>{{ $stem->meta_robots }}</th>
                </tr>
                <tr>
                    <th>Meta Description</th>
                    <th>{{ $stem->meta_description }}</th>
                </tr>
            </table>
        </div><!-- /.col -->
        <div class="col">
            <h2>Stores</h2>
            <table class="table">
                <tr>
                    <th>Beatport</th>
                    <th>{{ $stem->beatport }}</th>
                </tr>
                <tr>
                    <th>Traxsource</th>
                    <th>{{ $stem->traxsource }}</th>
                </tr>
                <tr>
                    <th>Juno Download</th>
                    <th>{{ $stem->juno }}</th>
                </tr>
            </table>
        </div><!-- /.col -->
    </div><!-- /.row -->

    <div class="row mb-4 ml-4">
        <div class="col-md-6">
            <h2>Description</h2>
            {!! $stem->description !!}
        </div><!-- /.col -->
        <div class="col-md-6">
            <h2>Dates</h2>

            <table class="table">
                <tr>
                    <th>Created At</th>
                    <td>{{ $stem->created_at }}</td>
                </tr>
                <tr>
                    <th>Updated At</th>
                    <td>{{ $stem->updated_at }}</td>
                </tr>
                <tr>
                    <th>Released At</th>
                    <td>{{ $stem->released_at }}</td>
                </tr>
            </table>
        </div><!-- /.col -->
    </div><!-- /.row -->
</div><!-- /.card -->
<a href="{{ route('admin.stems.index') }}" class="btn btn-primary">Back</a>
@endsection
