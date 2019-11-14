@extends('templates.admin')
@section('page_title', 'Users')

@section('content')
<div class="card">
    <div class="card-header">
        <div class="card-title">Users List</div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Type</th>
                        <th class="text-center">Active</th>
                        <th class="text-right">
                            <a class="btn btn-primary" href="{{ route('admin.users.create') }}" title="Create User">
                                <i class="fas fa-file"></i>
                            </a>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>{{ $user->full_name() }}</td>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->type == 'admin' ? 'Administrator' : 'Guest' }}</td>
                        <td class="text-center">
                            <form action="{{ route('admin.users.active', $user) }}" method="POST">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="_method" value="PATCH">
                                @if($user->active)
                                    <button type="submit" class="btn btn-success" title="Disable User">
                                        <i class="fas fa-check"></i>
                                    </button>
                                @else
                                    <button type="submit" class="btn btn-danger" title="Active User">
                                        <i class="fas fa-times"></i>
                                    </button>
                                @endif

                            </form>
                        </td>
                        <td class="text-center">
                            <a class="btn btn-info" href="{{ route('admin.users.show', $user) }}" title="User Info"><i class="fas fa-info"></i></a>
                            <a class="btn btn-warning" href="{{ route('admin.users.edit', $user) }}" title="Edit User"><i class="fas fa-edit"></i></a>

                            <form action="{{ route('admin.users.destroy', $user) }}" style="display:inline" method="POST" id="delete">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="_method" value="DELETE">
                                <button class="btn btn-danger" title="Delete User"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- .card  -->
@endsection

@section('custom-scripts')
<script>
    $(document).on("submit", "#delete", function() {
        return confirm("¿ Desea eliminar el usuario ?");
    });
</script>
@endsection
