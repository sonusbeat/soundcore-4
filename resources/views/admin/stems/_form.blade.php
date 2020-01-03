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
                            {{ (isset($stem) and ($stem->artist_id == $artist->id)) ? " selected" : null }}
                            {{ old('artist_id') == $artist->id ? " selected" : null }}
                            >{{ $artist->artist_name }}</option>
                        @endforeach
                    </select>
                    @error('artist_id')
                        <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Album -->
            @isset($albums)
            <div class="form-group row">
                <label for="artist_id" class="col-sm-3 text-right control-label col-form-label">Album</label>
                <div class="col-sm-9">
                    <select name="album_id" id="album_id" class="custom-select @error('album_id') is-invalid @enderror">
                        <option disabled selected>Select an option</option>
                        <option value="0"
                            @isset($stem)
                                {{ $stem->album_id == 0 ? ' selected' : '' }}
                            @else
                                {{ old('album_id') ? ' selected' : '' }}
                            @endisset
                        >
                            Not Applicable
                        </option>
                        @if(isset($albums) && $albums->count())
                            @foreach($albums as $album)
                                <option value="{{ $album->id }}"
                                 {{ (isset($single) and ($single->album_id == $album->id)) ? " selected" : null }}
                                 {{ old('album_id') == $album->id ? " selected" : null }}
                                >{{ $album->name }}</option>
                            @endforeach
                        @endif
                    </select>
                    @error('album_id')
                        <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            @endisset

            <!-- Title -->
            <div class="form-group row">
                <label for="title" class="col-sm-3 text-right control-label col-form-label">Title</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ isset($stem) ? $stem->title : old('title') }}">
                    @error('title')
                        <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Permalink -->
            <div class="form-group row">
                <label for="permalink" class="col-sm-3 text-right control-label col-form-label">Permalink</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control @error('permalink') is-invalid @enderror" id="permalink" name="permalink" value="{{ isset($stem) ? $stem->permalink : old('permalink') }}">
                    @error('permalink')
                    <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Version -->
            <div class="form-group row">
                <label for="version" class="col-sm-3 text-right control-label col-form-label">Version</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control @error('version') is-invalid @enderror" id="version" name="version" value="{{ isset($stem) ? $stem->version : old('version') }}">
                    @error('version')
                    <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Catalog -->
            <div class="form-group row">
                <label for="catalog" class="col-sm-3 text-right control-label col-form-label">Catalog</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control @error('catalog') is-invalid @enderror" id="catalog" name="catalog" value="{{ isset($stem) ? $stem->catalog : old('catalog') }}">
                    @error('catalog')
                    <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- UPC -->
            <div class="form-group row">
                <label for="upc" class="col-sm-3 text-right control-label col-form-label">UPC</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control @error('upc') is-invalid @enderror" id="upc" name="upc"
                           value="{{ isset($stem) ? $stem->upc : old('upc') }}">
                    @error('upc')
                    <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- ISRC -->
            <div class="form-group row">
                <label for="isrc" class="col-sm-3 text-right control-label col-form-label">ISRC</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control @error('isrc') is-invalid @enderror" id="isrc" name="isrc" value="{{ isset($stem) ? $stem->isrc : old('isrc') }}">
                    @error('isrc')
                    <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div><!-- /.col -->
        <div class="col">
            <!-- Released At -->
            <div class="form-group row">
                <label for="released_at" class="col-sm-3 text-right control-label col-form-label">Released At</label>
                <div class="col-sm-9">
                    <input type="date" class="form-control @error('released_at') is-invalid @enderror" id="released_at" name="released_at" value="{{ isset($stem) ? $stem->released_at : old('released_at') }}">
                    @error('released_at')
                    <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Genre -->
            <div class="form-group row">
                <label for="genre" class="col-sm-3 text-right control-label col-form-label">Genre</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control @error('genre') is-invalid @enderror" id="genre" name="genre" value="{{ isset($stem) ? $stem->genre : old('genre') }}">
                    @error('genre')
                    <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Time -->
            <div class="form-group row">
                <label for="time" class="col-sm-3 text-right control-label col-form-label">Time</label>
                <div class="col-sm-9">
                    <input type="time" class="form-control @error('time') is-invalid @enderror" id="time" name="time" value="{{ isset($stem) ? $stem->time : old('time') }}">
                    @error('time')
                    <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- BPM -->
            <div class="form-group row">
                <label for="bpm" class="col-sm-3 text-right control-label col-form-label">BPM</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control @error('bpm') is-invalid @enderror" id="bpm" name="bpm" value="{{ isset($stem) ? $stem->bpm : old('bpm') }}">
                    @error('bpm')
                    <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- KEY -->
            <div class="form-group row">
                <label for="key" class="col-sm-3 text-right control-label col-form-label">KEY</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control @error('key') is-invalid @enderror" id="key" name="key" value="{{ isset($stem) ? $stem->key : old('key') }}">
                    @error('key')
                    <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Secondary Genre -->
            <div class="form-group row">
                <label for="secondary_genre" class="col-sm-3 text-right control-label col-form-label">Secondary Genre</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control @error('secondary_genre') is-invalid @enderror" id="secondary_genre" name="secondary_genre" value="{{ isset($stem) ? $stem->secondary_genre : old('secondary_genre') }}">
                    @error('secondary_genre')
                    <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div><!-- /.col -->
    </div><!-- /.row -->
    <hr>
    <div class="row">
        <div class="col-5">
            @if(isset($stem) && $stem->coverart != '')
                <img class="img-fluid" src="/images/stems/{{ $stem->coverart }}-medium.jpg" alt="{{ $stem->coverart_alt }}" title="{{ $stem->coverart_alt }}">
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
                <input type="text" class="form-control @error('coverart_alt') is-invalid @enderror" id="coverart_alt" name="coverart_alt" value="{{ isset($stem) ? $stem->coverart_alt : old('coverart_alt') }}">

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

        <textarea type="text" class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="10">{{ isset($stem) ? $stem->description : old('description') }}</textarea>

        @error('description')
        <div class="alert alert-danger mt-3">{{ $message }}</div>
        @enderror
    </div>

    <h2>Stores</h2>

    <div class="row">
        <div class="col-sm-12 col-md-6">
            <!-- Beatport -->
            <div class="form-group row">
                <label for="beatport" class="col-sm-3 text-right control-label col-form-label">Beatport</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control @error('beatport') is-invalid @enderror" id="beatport" name="beatport" value="{{ isset($stem) ? $stem->beatport : old('beatport') }}">
                    @error('facebook')
                    <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Traxsource -->
            <div class="form-group row">
                <label for="traxsource" class="col-sm-3 text-right control-label col-form-label">Traxsource</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control @error('traxsource') is-invalid @enderror" id="traxsource" name="traxsource" value="{{ isset($stem) ? $stem->traxsource : old('traxsource') }}">
                    @error('traxsource')
                    <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Juno Download -->
            <div class="form-group row">
                <label for="juno" class="col-sm-3 text-right control-label col-form-label">Juno Download</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control @error('juno') is-invalid @enderror" id="juno" name="juno" value="{{ isset($stem) ? $stem->juno : old('juno') }}">
                    @error('juno')
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
                    <input type="text" class="form-control @error('meta_title') is-invalid @enderror" id="meta_title" name="meta_title" value="{{ isset($stem) ? $stem->meta_title : old('meta_title') }}">
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
                            {{ (isset($stem) and ($stem->meta_robots == $meta_value)) ? " selected" : null }}
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

                <textarea type="text" class="form-control @error('meta_description') is-invalid @enderror" id="meta_description" name="meta_description" rows="3">{{ isset($stem) ? $stem->meta_description : old('meta_description') }}</textarea>

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
        <a class="btn btn-primary" href="{{ route('admin.stems.index') }}" title="Cancel"><i class="fas fa-times"></i></a>
        <button type="submit" class="btn btn-success" title="Save"><i class="fas fa-save"></i></button>
    </div><!-- /.card-body -->
</div><!-- End Button Save -->
