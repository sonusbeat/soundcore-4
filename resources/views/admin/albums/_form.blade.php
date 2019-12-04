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
            <!-- Artist -->
            <div class="form-group row">
                <label for="artist_id" class="col-sm-3 text-right control-label col-form-label">Artist</label>
                <div class="col-sm-9">
                    <select name="artist_id" id="artist_id" class="custom-select @error('artist_id') is-invalid @enderror">
                        <option disabled selected>Select an option</option>
                        @foreach($artists as $artist)
                            <option value="{{ $artist->id }}"
                            {{ (isset($album) and ($album->artist_id == $artist->id)) ? " selected" : null }}
                            {{ old('artist_id') == $artist->id ? " selected" : null }}
                            >{{ $artist->artist_name }}</option>
                        @endforeach
                    </select>
                    @error('artist_id')
                        <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Name -->
            <div class="form-group row">
                <label for="name" class="col-sm-3 text-right control-label col-form-label">Name</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ isset($album) ? $album->name : old('name') }}">
                    @error('name')
                        <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Permalink -->
            <div class="form-group row">
                <label for="permalink" class="col-sm-3 text-right control-label col-form-label">Permalink</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control @error('permalink') is-invalid @enderror" id="permalink" name="permalink" value="{{ isset($album) ? $album->permalink : old('permalink') }}">
                    @error('permalink')
                    <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Catalog -->
            <div class="form-group row">
                <label for="catalog" class="col-sm-3 text-right control-label col-form-label">Catalog</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control @error('catalog') is-invalid @enderror" id="catalog" name="catalog" value="{{ isset($album) ? $album->catalog : old('catalog') }}">
                    @error('catalog')
                    <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- UPC -->
            <div class="form-group row">
                <label for="upc" class="col-sm-3 text-right control-label col-form-label">UPC</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control @error('upc') is-invalid @enderror" id="upc" name="upc" value="{{ isset($album) ? $album->upc : old('upc') }}">
                    @error('upc')
                    <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div><!-- /.col -->
        <div class="col">
            <!-- ISRC -->
            <div class="form-group row">
                <label for="isrc" class="col-sm-3 text-right control-label col-form-label">ISRC</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control @error('isrc') is-invalid @enderror" id="isrc" name="isrc" value="{{ isset($album) ? $album->isrc : old('isrc') }}">
                    @error('isrc')
                    <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Tracks Quantity -->
            <div class="form-group row">
                <label for="tracks_quantity" class="col-sm-3 text-right control-label col-form-label">Tracks Quantity</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control @error('tracks_quantity') is-invalid @enderror" id="tracks_quantity" name="tracks_quantity" value="{{ isset($album) ? $album->tracks_quantity : old('tracks_quantity') }}">
                    @error('tracks_quantity')
                    <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Various Artists -->
            <div class="form-group row">
                <label for="tracks_quantity" class="col-sm-3 text-right control-label col-form-label">Various Artists</label>
                <div class="col-sm-9">
                    <div class="form-check form-check-inline">
                      <input
                          class="form-check-input"
                          type="radio"
                          name="various_artists"
                          id="inlineRadio1"
                          value="1"
                          {{ isset($album) && $album->various_artists == 1 ? 'checked' : null }}
                          {{ old('various_artists') == 1 ? 'checked' : null }}
                      >
                      <label class="form-check-label" for="inlineRadio1">Yes</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input
                          class="form-check-input"
                          type="radio"
                          name="various_artists"
                          id="inlineRadio2"
                          value="0"
                          {{ isset($album) && $album->various_artists == 0 ? 'checked' : null }}
                          {{ !isset($album) && old('various_artists') == 0 ? 'checked' : null }}
                      >
                      <label class="form-check-label" for="inlineRadio2">No</label>
                    </div>
                    @error('various_artists')
                    <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Genre -->
            <div class="form-group row">
                <label for="genre" class="col-sm-3 text-right control-label col-form-label">Genre</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control @error('genre') is-invalid @enderror" id="genre" name="genre" value="{{ isset($album) ? $album->genre : old('genre') }}">
                    @error('genre')
                    <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Released At -->
            <div class="form-group row">
                <label for="released_at" class="col-sm-3 text-right control-label col-form-label">Released At</label>
                <div class="col-sm-9">
                    <input type="date" class="form-control @error('released_at') is-invalid @enderror" id="released_at" name="released_at" value="{{ isset($album) ? $album->released_at : old('released_at') }}">
                    @error('released_at')
                    <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div><!-- /.col -->
    </div><!-- /.row -->
    <hr>
    <div class="row">
        <div class="col-5">
            @if(isset($album) && $album->coverart != '')
                <img class="img-fluid" src="/images/releases/albums/{{ $album->coverart }}-medium.jpg" alt="{{ $album->coverart_alt }}" title="{{ $album->coverart_alt }}">
            @else
                <img class="img-fluid" src="/images/no-image.jpg" alt="No Image Available" title="No Image Available">
            @endif
        </div><!-- /.col -->

        <!-- Image -->
        <div class="col-7 d-flex flex-column justify-content-center">

            <div class="form-group">
                <label for="coverart">Coverart</label>

                <input type="file" class="form-control @error('coverart') is-invalid @enderror" id="coverart" name="coverart">

                @error('coverart')
                <div class="alert alert-danger mt-3">{{ $message }}</div>
                @enderror
            </div>

            <!-- Image Alt -->
            <div class="form-group">
                <label for="coverart_alt">Alternative Image Text</label>
                <input type="text" class="form-control @error('coverart_alt') is-invalid @enderror" id="coverart_alt" name="coverart_alt" value="{{ isset($album) ? $album->coverart_alt : old('coverart_alt') }}">

                @error('coverart_alt')
                <div class="alert alert-danger mt-3">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div><!-- /.row -->

    <hr>
    <!-- Description -->
    <div class="form-group">
        <label for="description">Description</label>

        <textarea type="text" class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="10">{{ isset($album) ? $album->description : old('description') }}</textarea>

        @error('description')
        <div class="alert alert-danger mt-3">{{ $message }}</div>
        @enderror
    </div>

    <h2>Stores</h2>

    <div class="row">
        <div class="col">
            <!-- Beatport -->
            <div class="form-group row">
                <label for="beatport" class="col-sm-3 text-right control-label col-form-label">Beatport</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control @error('beatport') is-invalid @enderror" id="beatport" name="beatport" value="{{ isset($album) ? $album->beatport : old('beatport') }}">
                    @error('facebook')
                    <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Itunes -->
            <div class="form-group row">
                <label for="itunes" class="col-sm-3 text-right control-label col-form-label">Itunes</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control @error('itunes') is-invalid @enderror" id="itunes" name="itunes" value="{{ isset($album) ? $album->itunes : old('itunes') }}">
                    @error('itunes')
                    <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Spotify -->
            <div class="form-group row">
                <label for="spotify" class="col-sm-3 text-right control-label col-form-label">Spotify</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control @error('spotify') is-invalid @enderror" id="spotify" name="spotify" value="{{ isset($album) ? $album->spotify : old('spotify') }}">
                    @error('spotify')
                    <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div><!-- /.col -->
        <div class="col">
            <!-- Deezer -->
            <div class="form-group row">
                <label for="deezer" class="col-sm-3 text-right control-label col-form-label">Deezer</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control @error('deezer') is-invalid @enderror" id="deezer" name="deezer" value="{{ isset($album) ? $album->deezer : old('deezer') }}">
                    @error('deezer')
                    <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Soundcloud -->
            <div class="form-group row">
                <label for="soundcloud" class="col-sm-3 text-right control-label col-form-label">Soundcloud</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control @error('soundcloud') is-invalid @enderror" id="soundcloud" name="soundcloud" value="{{ isset($album) ? $album->soundcloud : old('soundcloud') }}">
                    @error('soundcloud')
                    <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Youtube -->
            <div class="form-group row">
                <label for="youtube" class="col-sm-3 text-right control-label col-form-label">Youtube</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control @error('youtube') is-invalid @enderror" id="youtube" name="youtube" value="{{ isset($album) ? $album->youtube : old('youtube') }}">
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
                    <input type="text" class="form-control @error('meta_title') is-invalid @enderror" id="meta_title" name="meta_title" value="{{ isset($album) ? $album->meta_title : old('meta_title') }}">
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
                            {{ (isset($album) and ($album->meta_robots == $meta_value)) ? " selected" : null }}
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

                <textarea type="text" class="form-control @error('meta_description') is-invalid @enderror" id="meta_description" name="meta_description" rows="3">{{ isset($album) ? $album->meta_description : old('meta_description') }}</textarea>

                @error('meta_description')
                <div class="alert alert-danger mt-3">{{ $message }}</div>
                @enderror
            </div>
        </div><!-- /.col -->
    </div><!-- /.row -->
</div><!-- /.card-body -->

<!-- Button Save -->
<div class="border-top">
    <div class="card-body text-right">
        <a class="btn btn-primary" href="{{ route('admin.albums.index') }}" title="Cancel"><i class="fas fa-times"></i></a>
        <button type="submit" class="btn btn-success" title="Save"><i class="fas fa-save"></i></button>
    </div><!-- /.card-body -->
</div><!-- End Button Save -->
