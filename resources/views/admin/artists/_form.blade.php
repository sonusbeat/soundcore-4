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
            <!-- Artist Name -->
            <div class="form-group row">
                <label for="artist_name" class="col-sm-3 text-right control-label col-form-label">Artist Name</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control @error('artist_name') is-invalid @enderror" id="artist_name" name="artist_name" value="{{ isset($artist) ? $artist->artist_name : old('artist_name') }}">
                    @error('artist_name')
                        <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- First Name -->
            <div class="form-group row">
                <label for="first_name" class="col-sm-3 text-right control-label col-form-label">First Name</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control @error('first_name') is-invalid @enderror" id="first_name" name="first_name" value="{{ isset($artist) ? $artist->first_name : old('first_name') }}">
                    @error('first_name')
                    <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Last Name -->
            <div class="form-group row">
                <label for="last_name" class="col-sm-3 text-right control-label col-form-label">Last Name</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control @error('last_name') is-invalid @enderror" id="last_name" name="last_name" value="{{ isset($artist) ? $artist->last_name : old('last_name') }}">
                    @error('last_name')
                    <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Permalink -->
            <div class="form-group row">
                <label for="permalink" class="col-sm-3 text-right control-label col-form-label">Permalink</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control @error('permalink') is-invalid @enderror" id="permalink" name="permalink" value="{{ isset($artist) ? $artist->permalink : old('permalink') }}">
                    @error('permalink')
                    <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div><!-- /.col -->
        <div class="col">
            <!-- Email -->
            <div class="form-group row">
                <label for="email" class="col-sm-3 text-right control-label col-form-label">Email</label>
                <div class="col-sm-9">
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ isset($artist) ? $artist->email : old('email') }}">
                    @error('email')
                    <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Nationality -->
            <div class="form-group row">
                <label for="nationality" class="col-sm-3 text-right control-label col-form-label">Nationality</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control @error('nationality') is-invalid @enderror" id="nationality" name="nationality" value="{{ isset($artist) ? $artist->nationality : old('nationality') }}">
                    @error('nationality')
                    <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            @if(!isset($artist))
            <!-- Image -->
            <div class="form-group row">
                <label for="image" class="col-sm-3 text-right control-label col-form-label">Image</label>
                <div class="col-sm-9">
                    <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image">
                    @error('image')
                    <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Image Alt -->
            <div class="form-group row">
                <label for="image_alt" class="col-sm-3 text-right control-label col-form-label">Alternative Image Text</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control @error('image_alt') is-invalid @enderror" id="image_alt" name="image_alt" value="{{ isset($artist) ? $artist->image_alt : old('image_alt') }}">
                    @error('image_alt')
                    <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            @endif
        </div><!-- /.col -->
    </div><!-- /.row -->

    <!-- Biography -->
    <div class="form-group">
        <label for="biography">Biography</label>

        <textarea type="text" class="form-control @error('biography') is-invalid @enderror" id="biography" name="biography" rows="10">{{ isset($artist) ? $artist->biography : old('biography') }}</textarea>

        @error('biography')
        <div class="alert alert-danger mt-3">{{ $message }}</div>
        @enderror
    </div>

    <h2>Social Media</h2>

    <div class="row">
        <div class="col">
            <!-- Facebook -->
            <div class="form-group row">
                <label for="facebook" class="col-sm-3 text-right control-label col-form-label">Facebook</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control @error('facebook') is-invalid @enderror" id="facebook" name="facebook" value="{{ isset($artist) ? $artist->facebook : old('facebook') }}">
                    @error('facebook')
                    <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Twitter -->
            <div class="form-group row">
                <label for="twitter" class="col-sm-3 text-right control-label col-form-label">Twitter</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control @error('twitter') is-invalid @enderror" id="twitter" name="twitter" value="{{ isset($artist) ? $artist->twitter : old('twitter') }}">
                    @error('twitter')
                    <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Instagram -->
            <div class="form-group row">
                <label for="instagram" class="col-sm-3 text-right control-label col-form-label">Instagram</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control @error('instagram') is-invalid @enderror" id="instagram" name="instagram" value="{{ isset($artist) ? $artist->instagram : old('instagram') }}">
                    @error('instagram')
                    <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div><!-- /.col -->
        <div class="col">
            <!-- Soundcloud -->
            <div class="form-group row">
                <label for="soundcloud" class="col-sm-3 text-right control-label col-form-label">Soundcloud</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control @error('soundcloud') is-invalid @enderror" id="soundcloud" name="soundcloud" value="{{ isset($artist) ? $artist->soundcloud : old('soundcloud') }}">
                    @error('soundcloud')
                    <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Youtube -->
            <div class="form-group row">
                <label for="youtube" class="col-sm-3 text-right control-label col-form-label">Youtube</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control @error('youtube') is-invalid @enderror" id="youtube" name="youtube" value="{{ isset($artist) ? $artist->youtube : old('youtube') }}">
                    @error('youtube')
                    <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div><!-- /.col -->
    </div><!-- /.row -->

    <h2>Seo</h2>

    <div class="row">
        <div class="col">
            <!-- Meta Title -->
            <div class="form-group row">
                <label for="meta_title" class="col-sm-3 text-right control-label col-form-label">Meta Title</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control @error('meta_title') is-invalid @enderror" id="meta_title" name="meta_title" value="{{ isset($artist) ? $artist->meta_title : old('meta_title') }}">
                    @error('meta_title')
                    <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Meta Robots -->
            <div class="form-group row">
                <label for="meta_robots" class="col-sm-3 text-right control-label col-form-label">Meta Robots</label>
                <div class="col-sm-9">
                    <select name="meta_robots" id="meta_robots" class="custom-select @error('meta_robots') is-invalid @enderror">
                        <option disabled selected>Select an option</option>
                        @foreach($meta_robots as $meta_name => $meta_value)
                            <option value="{{ $meta_value }}"
                            {{ (isset($artist) and ($artist->meta_robots == $meta_value)) ? " selected" : null }}
                            {{ old('meta_robots') == $meta_value ? " selected" : null }}
                            >{{ $meta_name }}</option>
                        @endforeach
                    </select>
                    @error('meta_robots')
                    <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div><!-- /.col -->
        <div class="col">
            <!-- Meta Description -->
            <div class="form-group">
                <label for="meta_description">Meta Description</label>

                <textarea type="text" class="form-control @error('meta_description') is-invalid @enderror" id="meta_description" name="meta_description" rows="3">{{ isset($artist) ? $artist->meta_description : old('meta_description') }}</textarea>

                @error('meta_description')
                <div class="alert alert-danger mt-3">{{ $message }}</div>
                @enderror
            </div>
        </div><!-- /.col -->
    </div><!-- /.row -->

    @isset($artist)
    <div class="row">
        <div class="col-5">
            <img class="img-fluid" src="/images/artists/{{ $artist->image }}" alt="">
        </div><!-- /.col -->

        <!-- Image -->
        <div class="col-7 d-flex flex-column justify-content-center">

            <div class="form-group">
                <label for="image">Image</label>

                <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image">

                @error('image')
                <div class="alert alert-danger mt-3">{{ $message }}</div>
                @enderror
            </div>

            <!-- Image Alt -->
            <div class="form-group">
                <label for="image_alt">Alternative Image Text</label>
                <input type="text" class="form-control @error('image_alt') is-invalid @enderror" id="image_alt" name="image_alt" value="{{ isset($artist) ? $artist->image_alt : old('image_alt') }}">

                @error('image_alt')
                <div class="alert alert-danger mt-3">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div><!-- /.row -->
    @endisset
</div><!-- /.card-body -->

<!-- Button Save -->
<div class="border-top">
    <div class="card-body text-right">
        <a class="btn btn-primary" href="{{ route('admin.artists.index') }}" title="Cancel"><i class="fas fa-times"></i></a>
        <button type="submit" class="btn btn-success" title="Save"><i class="fas fa-save"></i></button>
    </div><!-- /.card-body -->
</div><!-- End Button Save -->


