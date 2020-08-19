<div class="form-group">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    @if(isset($commercials))
        <div class="form-group" display="none">
            <input class="hidden" name="id" id="id" value="{{ $commercials->id }}">
        </div>
    @endif
    <div class="form-group">
        <div class="col-md-2">
            <label class="control-label">Slika:</label>
        </div>
        <div class="col-md-10">
            <input type="file" name="photos" id="uploadPhotoFiles" class="uploadPhotoFiles" accept="image/jpg, image/jpeg, image/png" multiple />
        </div>
        @if(isset($commercials))
            <div class="form-group">
                <div class="col-md-2" id="imagediv_{{$commercials->id}}">
                    <div class="box-head">
                        <header>
                        </header>
                        <div class="tools">
                            <div class="btn-group btn-group-transparent">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-equal btn-sm removeImageDiv" id="remove_{{$commercials->id}}"><i class="fa fa-times"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <img class="thumbnail" src="{{asset($commercials->image)}}" style="background-color: #f7f7f7; width:100%">
                </div>
            </div>
            <input type="hidden" id="removeimage" name="removeimage" value="false">
        @endif
    </div>
    <div class = "form-group">
        <div class="col-md-2">
            <label class="control-label">Tag Slike:</label>
        </div>
        <div class="col-md-10">
            @if(isset($commercials)) <input type="text" name="image_tag" id = "image_tag" class="form-control" @error('image_tag') is-invalid @enderror placeholder="Tag" value="{{ $commercials->image_tag }}" required />
            @else <input type="text" name="image_tag" id ="image_tag" class="form-control form-validate" @error('image_tag') is-invalid @enderror placeholder="Tag" value="{{ old('image_tag') }}" required />
            @endif
            @error('image_tag')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class = "form-group">
        <div class="col-md-2">
            <label class="control-label">Naslov:</label>
        </div>
        <div class="col-md-10">
            @if(isset($commercials)) <input type="title" name="title" id = "title" class="form-control" @error('title') is-invalid @enderror placeholder="Naslov" value="{{ $commercials->title }}" required />
            @else <input type="text" name="title" id ="title" class="form-control form-validate" @error('title') is-invalid @enderror placeholder="Naslov" value="{{ old('title') }}" required />
            @endif
            @error('title')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class = "form-group">
        <div class="col-md-2">
            <label class="control-label">Link:</label>
        </div>
        <div class="col-md-10">
            @if(isset($commercials)) <input type="url" name="link" id = "link" class="form-control" @error('link') is-invalid @enderror placeholder="Link" value="{{ $commercials->link }}" required/>
            @else <input type="url" name="link" id ="link" class="form-control form-validate" @error('link') is-invalid @enderror placeholder="Link" value="{{ old('link') }}" required/>
            @endif
            @error('link')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-2">
            <label class="control-label">Tekst:</label>
        </div>
        <div class="col-md-10">
            @if(isset($commercials)) <textarea id="wysiwyg" class="form-control control-5-rows textarea"  @error('text') is-invalid @enderror placeholder="Enter text ..." spellcheck="false" name="text" >{{ $commercials->text }}</textarea>
            @else <textarea id="wysiwyg" class="form-control control-5-rows textarea"  @error('text') is-invalid @enderror placeholder="Unesite tekst ..." spellcheck="false" name="text" >{{ old('text') }}</textarea>
            @endif
            @error('text')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="form-group">
        <div class="form-footer col-lg-offset-1 col-md-offset-1 col-sm-9">
            <button type="button" class="btn btn-primary" id="addBuilding" data-toggle="modal" data-target="#simpleModal">{{$submit}} Reklamu</button>
        </div>
    </div>
    <!-- START SIMPLE MODAL MARKUP -->
    <div class="modal fade" id="simpleModal" tabindex="-1" role="dialog" aria-labelledby="simpleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="simpleModalLabel">Sačuvajte promene</h4>
                </div>
                <div class="modal-body">
                    <p><text>Da li želite da </text> @if ($submit == 'Dodaj')<text>dodate</text>
                        @elseif ($submit == 'Uredi')<text>uredite</text>
                        @endif <text>ovu Reklamu?</text>
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Ne</button>
                    <button type="submit" id="submitBuilding" class="btn btn-primary">Sačuvaj</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <!-- END SIMPLE MODAL MARKUP -->
</div>
