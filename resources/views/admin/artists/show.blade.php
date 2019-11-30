@extends('templates.admin')
@section('page_title', 'Artist')

@section('content')
<div class="card mb-3">
    <div class="row no-gutters">
        <div class="col-md-5 mb-4">
            <img class="img-fluid" src="{{ asset('/images/artists/'.$artist->image) }}" alt="{{ $artist->artist_name }}" title="{{ $artist->artist_name }}">
        </div>
        <div class="col-md-7">
            <div class="card-body">
                <h2 class="card-title">{{ $artist->artist_name }}</h2>
                <table class="table">
                    <tr>
                        <th>First Name:</th>
                        <td>{{ $artist->first_name }}</td>
                    </tr>
                    <tr>
                        <th>Last Name:</th>
                        <td>{{ $artist->last_name }}</td>
                    </tr>
                    <tr>
                        <th>Permalink:</th>
                        <td>{{ $artist->permalink }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{ $artist->email }}</td>
                    </tr>
                    <tr>
                        <th>Nationality</th>
                        <td>{{ $artist->nationality }}</td>
                    </tr>
                    <tr>
                        <th>Active</th>
                        <td><i class="fas fa-{{ $artist->active ? 'check text-success' : 'times text-danger' }}"></i></td>
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
                    <th>{{ $artist->meta_title }}</th>
                </tr>
                <tr>
                    <th>Meta Robots</th>
                    <th>{{ $artist->meta_robots }}</th>
                </tr>
                <tr>
                    <th>Meta Description</th>
                    <th>{{ $artist->meta_description }}</th>
                </tr>
            </table>
        </div><!-- /.col -->
        <div class="col">
            <h2>Social Media</h2>
            <table class="table">
                    <tr>
                        <th>Facebook</th>
                        <th>{{ $artist->facebook }}</th>
                    </tr>
                    <tr>
                        <th>Instagram</th>
                        <th>{{ $artist->instagram }}</th>
                    </tr>
                    <tr>
                        <th>Twitter</th>
                        <th>{{ $artist->twitter }}</th>
                    </tr>
                    <tr>
                        <th>Youtube</th>
                        <th>{{ $artist->youtube }}</th>
                    </tr>
                    <tr>
                        <th>Soundcloud</th>
                        <th>{{ $artist->youtube }}</th>
                    </tr>
                </table>
        </div><!-- /.col -->
    </div><!-- /.row -->

    <div class="row mb-4 ml-4">
        <div class="col-md-6">
            <h2>Biography</h2>
            {!! $artist->biography !!}
        </div><!-- /.col -->
        <div class="col-md-6">
            <h2>Dates</h2>

            <table class="table">
                <tr>
                    <th>Created At</th>
                    <td>{{ $artist->created_at }}</td>
                </tr>
                <tr>
                    <th>Updated At</th>
                    <td>{{ $artist->updated_at }}</td>
                </tr>
            </table>
        </div><!-- /.col -->
    </div><!-- /.row -->

<div class="row ml-4 mb-4">
    <div class="col-md-6">
        <h2>Songs</h2>

        <ul>
            @foreach($artist->singles as $single)
            <li>
                <a href="{{ route('admin.singles.show', $single->id) }}">
                    {{ $single->title }}
                </a>
            </li>
            @endforeach
        </ul>
    </div>
</div>

</div><!-- /.card -->
<a href="{{ route('admin.artists.index') }}" class="btn btn-primary">Back</a>
@endsection
