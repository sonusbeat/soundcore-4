<div class="card-body">
    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <p class="font-weight-bold">There {{ count($errors->all()) > 1 ? 'are errors' : 'is 1 error' }} in the form</p>
            <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
            </ul>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="row">
        <div class="col">
            <!-- First Name -->
            <div class="form-group row">
                <label for="first_name" class="col-sm-3 text-right control-label col-form-label">First Name</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control @error('first_name') is-invalid @enderror" id="first_name" name="first_name" value="{{ isset($user) ? $user->first_name : old('first_name') }}">
                    @error('first_name')
                        <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror
                </div>

            </div>

            <!-- Last Name -->
            <div class="form-group row">
                <label for="last_name" class="col-sm-3 text-right control-label col-form-label">Last Name</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control @error('last_name') is-invalid @enderror" id="last_name" name="last_name" value="{{ isset($user) ? $user->last_name : old('last_name') }}">
                    @error('last_name')
                    <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Username -->
            <div class="form-group row">
                <label for="username" class="col-sm-3 text-right control-label col-form-label">Username</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" value="{{ isset($user) ? $user->username : old('username') }}">
                    @error('username')
                    <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Email -->
            <div class="form-group row">
                <label for="email" class="col-sm-3 text-right control-label col-form-label">Email</label>
                <div class="col-sm-9">
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ isset($user) ? $user->email : old('email') }}">
                    @error('email')
                    <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
        <div class="col">
            @if(!isset($user))
            <!-- Image -->
            <div class="form-group row">
                <label for="image" class="col-sm-3 text-right control-label col-form-label">Image Profile</label>
                <div class="col-sm-9">
                    <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image">
                    @error('image')
                    <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            @endif

            <!-- Type -->
            <div class="form-group row">
                <label class="col-sm-3 text-right">Type</label>
                <div class="col-md-9">
                    <select name="type" class="select2 form-control @error('type') is-invalid @enderror custom-select" style="width: 100%; height:36px;">
                        <option disabled selected>Select</option>
                        <option value="guest"
                            {{ old('type') == 'guest' ? ' selected' : null }}
                            {{ isset($user) && $user->type == 'guest' ? ' selected' : null }}
                        >
                            Guest
                        </option>
                        <option value="admin"
                            {{ old('type') == 'admin' ? ' selected' : null }}
                            {{ isset($user) && $user->type == 'admin' ? ' selected' : null }}
                        >
                            Administrator
                        </option>
                    </select>
                    @error('type')
                    <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <!-- Password -->
            <div class="form-group row">
                <label for="password" class="col-sm-3 text-right control-label col-form-label">Password</label>
                <div class="col-sm-9">
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
                    @error('password')
                    <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Password Confirmation -->
            <div class="form-group row">
                <label for="password_confirmaion" class="col-sm-3 text-right control-label col-form-label">Password Confirmation</label>
                <div class="col-sm-9">
                    <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmaion" name="password_confirmation">
                    @error('password_confirmation')
                    <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
        <!-- /.col -->
    </div><!-- /.row -->
@isset($user)
    <div class="row">
        <div class="col-5">
            <img class="img-fluid" src="/images/users/{{ $user->image }}" alt="">
        </div>
        <div class="col-7 d-flex align-items-center">
            <div style="width:150px; text-align: right; margin-right: 15px;">
                <label for="image" class="control-label col-form-label">Image Profile</label>
            </div>
            <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image">
            @error('image')
            <div class="alert alert-danger mt-3">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>
@endisset
<!-- /.card-body -->

<!-- Button Save -->
<div class="border-top">
    <div class="card-body text-right">
        <a class="btn btn-primary" href="{{ route('admin.users.index') }}" title="Cancel"><i class="fas fa-times"></i></a>
        <button type="submit" class="btn btn-success" title="Save"><i class="fas fa-save"></i></button>
    </div>
    <!-- /.card-body -->
</div>
<!-- End Button Save -->

