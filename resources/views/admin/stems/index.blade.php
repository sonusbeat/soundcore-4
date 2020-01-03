@extends('templates.admin')
@section('page_title', 'stems')

@section('content')
<div class="card">
    <div class="card-header">
        <div class="card-title">Stems List</div>
        <div class="card-body">
            @if($stems->count())
            <table class="table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Artist</th>
                        <th>Album</th>
                        <th>Robots</th>
                        <th class="text-center">Active</th>
                        <th class="text-right">
                            <a class="btn btn-primary" href="{{ route('admin.stems.create') }}" title="Create Stem">
                                <i class="fas fa-file"></i>
                            </a>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($stems as $stem)
                    <tr>
                        <td>{{ $stem->title }}</td>
                        <td><a href="{{ route('admin.artists.show', $stem->artist->id) }}">{{ $stem->artist->artist_name }}</a></td>
                        @if($stem->album)
                            <td><a href="{{ route('admin.albums.show', $stem->album->id) }}">{{ $stem->album->name }}</a></td>
                        @else
                            <td><b>Not Applicable</b></td>
                        @endif
                        <td>{{ $stem->meta_robots }}</td>
                        <td class="text-center">
                            <form action="{{ route('admin.stems.active', $stem) }}" method="POST">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="_method" value="PATCH">
                                @if($stem->active)
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
                            <a class="btn btn-info" href="{{ route('admin.stems.show', $stem) }}" title="Stem Info"><i class="fas fa-info"></i></a>
                            <a class="btn btn-warning" href="{{ route('admin.stems.edit', $stem) }}" title="Edit Stem"><i class="fas fa-edit"></i></a>

                            <form action="{{ route('admin.stems.destroy', $stem) }}" style="display:inline" method="POST" id="delete">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="_method" value="DELETE">
                                <button class="btn btn-danger" title="Delete Stem"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
                <div class="alert alert-warning text-center font-weight-bold h3">
                    There aren't stems created yet !
                </div>
                <a class="btn btn-block btn-primary btn-lg" href="{{ route('admin.stems.create') }}">Create</a>
            @endif
        </div>
    </div>
</div>
<!-- .card  -->
@endsection

@section('custom-scripts')
<script>
    $(document).on("submit", "#delete", function() {
        return confirm("Do you want to delete this stem ?");
    });
</script>
@endsection
