@extends('templates.admin')
@section('page_title', 'Singles')

@section('content')
<div class="card">
    <div class="card-header">
        <div class="card-title">Singles List</div>
        <div class="card-body">
            @if($singles->count())
            <table class="table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Artist</th>
                        <th>Robots</th>
                        <th class="text-center">Active</th>
                        <th class="text-right">
                            <a class="btn btn-primary" href="{{ route('admin.singles.create') }}" title="Create Single">
                                <i class="fas fa-file"></i>
                            </a>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($singles as $single)
                    <tr>
                        <td>{{ $single->title }}</td>
                        <td><a href="{{ route('admin.artists.show', $single->artist->id) }}">{{ $single->artist->artist_name }}</a></td>
                        <td>{{ $single->meta_robots }}</td>
                        <td class="text-center">
                            <form action="{{ route('admin.singles.active', $single) }}" method="POST">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="_method" value="PATCH">
                                @if($single->active)
                                    <button type="submit" class="btn btn-success" title="Disable Single">
                                        <i class="fas fa-check"></i>
                                    </button>
                                @else
                                    <button type="submit" class="btn btn-danger" title="Active Single">
                                        <i class="fas fa-times"></i>
                                    </button>
                                @endif
                            </form>
                        </td>
                        <td class="text-center">
                            <a class="btn btn-info" href="{{ route('admin.singles.show', $single) }}" title="Single Info"><i class="fas fa-info"></i></a>
                            <a class="btn btn-warning" href="{{ route('admin.singles.edit', $single) }}" title="Edit Single"><i class="fas fa-edit"></i></a>

                            <form action="{{ route('admin.singles.destroy', $single) }}" style="display:inline" method="POST" id="delete">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="_method" value="DELETE">
                                <button class="btn btn-danger" title="Single Single"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
                <div class="alert alert-warning text-center font-weight-bold h3">
                    There are no singles created yet !
                </div>
                <a class="btn btn-block btn-primary btn-lg" href="{{ route('admin.singles.create') }}">Create</a>
            @endif
        </div>
    </div>
</div>
<!-- .card  -->
@endsection

@section('custom-scripts')
<script>
    $(document).on("submit", "#delete", function() {
        return confirm("Do you want to delete the single ?");
    });
</script>
@endsection
