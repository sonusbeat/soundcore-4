@extends('templates.admin')
@section('page_title', 'albums')

@section('content')
<div class="card">
    <div class="card-header">
        <div class="card-title">Albums List</div>
        <div class="card-body">
            @if($albums->count())
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Artist</th>
                        <th>Robots</th>
                        <th class="text-center">Active</th>
                        <th class="text-right">
                            <a class="btn btn-primary" href="{{ route('admin.albums.create') }}" title="Create Album">
                                <i class="fas fa-file"></i>
                            </a>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($albums as $album)
                    <tr>
                        <td>{{ $album->name }}</td>
                        <td><a href="{{ route('admin.artists.show', $album->artist->id) }}">{{ $album->artist->artist_name }}</a></td>
                        <td>{{ $album->meta_robots }}</td>
                        <td class="text-center">
                            <form action="{{ route('admin.albums.active', $album) }}" method="POST">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="_method" value="PATCH">
                                @if($album->active)
                                    <button type="submit" class="btn btn-success" title="Disable Album">
                                        <i class="fas fa-check"></i>
                                    </button>
                                @else
                                    <button type="submit" class="btn btn-danger" title="Active Album">
                                        <i class="fas fa-times"></i>
                                    </button>
                                @endif
                            </form>
                        </td>
                        <td class="text-center">
                            <a class="btn btn-info" href="{{ route('admin.albums.show', $album) }}" title="Album Info"><i class="fas fa-info"></i></a>
                            <a class="btn btn-warning" href="{{ route('admin.albums.edit', $album) }}" title="Edit Album"><i class="fas fa-edit"></i></a>

                            <form action="{{ route('admin.albums.destroy', $album) }}" style="display:inline" method="POST" id="delete">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="_method" value="DELETE">
                                <button class="btn btn-danger" title="Delete Album"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
                <div class="alert alert-warning text-center font-weight-bold h3">
                    There aren't albums created yet !
                </div>
                <a class="btn btn-block btn-primary btn-lg" href="{{ route('admin.albums.create') }}">Create</a>
            @endif
        </div>
    </div>
</div>
<!-- .card  -->
@endsection

@section('custom-scripts')
<script>
    $(document).on("submit", "#delete", function() {
        return confirm("Do you want to delete the album ?");
    });
</script>
@endsection
