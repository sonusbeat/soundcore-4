@extends('templates.admin')
@section('page_title', 'Artists')

@section('content')
<div class="card">
    <div class="card-header">
        <div class="card-title">Artists List</div>
        <div class="card-body">
            @if($artists->count())
            <table class="table">
                <thead>
                    <tr>
                        <th>Artist Name</th>
                        <th>Email</th>
                        <th>Robots</th>
                        <th class="text-center">Active</th>
                        <th class="text-right">
                            <a class="btn btn-primary" href="{{ route('admin.artists.create') }}" title="Create Artist">
                                <i class="fas fa-file"></i>
                            </a>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($artists as $artist)
                    <tr>
                        <td>{{ $artist->artist_name }}</td>
                        <td>{{ $artist->email }}</td>
                        <td>{{ $artist->meta_robots }}</td>
                        <td class="text-center">
                            <form action="{{ route('admin.artists.active', $artist) }}" method="POST">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="_method" value="PATCH">
                                @if($artist->active)
                                    <button type="submit" class="btn btn-success" title="Disable Artist">
                                        <i class="fas fa-check"></i>
                                    </button>
                                @else
                                    <button type="submit" class="btn btn-danger" title="Active Artist">
                                        <i class="fas fa-times"></i>
                                    </button>
                                @endif
                            </form>
                        </td>
                        <td class="text-center">
                            <a class="btn btn-info" href="{{ route('admin.artists.show', $artist) }}" title="User Info"><i class="fas fa-info"></i></a>
                            <a class="btn btn-warning" href="{{ route('admin.artists.edit', $artist) }}" title="Edit User"><i class="fas fa-edit"></i></a>

                            <form action="{{ route('admin.artists.destroy', $artist) }}" style="display:inline" method="POST" id="delete">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="_method" value="DELETE">
                                <button class="btn btn-danger" title="Delete User"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
                <div class="alert alert-warning text-center font-weight-bold h3">
                    There are no artists created yet !
                </div>
                <a class="btn btn-block btn-primary btn-lg" href="{{ route('admin.artists.create') }}">Create</a>
            @endif
        </div>
    </div>
</div>
<!-- .card  -->
@endsection

@section('custom-scripts')
<script>
    $(document).on("submit", "#delete", function() {
        return confirm("Do you want to delete the artist ?");
    });
</script>
@endsection
