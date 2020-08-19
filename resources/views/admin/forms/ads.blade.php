<div class="form-group">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    @if(isset($ad))
        <div class="form-group" display="none">
            <input class="hidden" name="id" id="id" value="{{ $ad->id }}">
        </div>
    @endif
    <div class="form-group">
        <div class="col-md-2">
            <label class="control-label">Slika Oglasa:</label>
        </div>
        <div class="col-md-10">
            <input type="file" name="photos" id="uploadPhotoFiles" class="uploadPhotoFiles" accept="image/jpg, image/jpeg, image/png" multiple />
        </div>
        @if(isset($ad))
            <div class="form-group">
                <div class="col-md-2" id="imagediv_{{$ad->id}}">
                    <div class="box-head">
                        <header>
                        </header>
                        <div class="tools">
                            <div class="btn-group btn-group-transparent">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-equal btn-sm removeImageDiv" id="remove_{{$ad->id}}"><i class="fa fa-times"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <img class="thumbnail" src="{{asset($ad->image)}}" style="background-color: #f7f7f7; width:100%">
                </div>
            </div>
            <input type="hidden" id="removeimage" name="removeimage" value="false">
        @endif
    </div>
    <div class = "form-group">
        <div class="col-md-2">
            <label class="control-label">Title Slike:</label>
        </div>
        <div class="col-md-10">
            @if(isset($ad)) <input type="text" name="image_title" id = "image_title" class="form-control" @error('image_title') is-invalid @enderror placeholder="Title slike" value="{{ $ad->image_title }}" required />
            @else <input type="text" name="image_title" id ="image_title" class="form-control form-validate" @error('image_title') is-invalid @enderror placeholder="Title slike" value="{{ old('image_title') }}" required />
            @endif
            @error('image_title')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class = "form-group">
        <div class="col-md-2">
            <label class="control-label">Link Slike:</label>
        </div>
        <div class="col-md-10">
            @if(isset($ad)) <input type="url" name="image_link" id = "image_link" class="form-control" @error('image_link') is-invalid @enderror placeholder="Link slike" value="{{ $ad->image_link }}" required/>
            @else <input type="url" name="image_link" id ="image_link" class="form-control form-validate" @error('image_link') is-invalid @enderror placeholder="Link slike" value="{{ old('image_link') }}" required/>
            @endif
            @error('image_link')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-2">
            <label class="control-label">Tekst:</label>
        </div>
        <div class="col-md-10">
            @if(isset($ad)) <textarea id="wysiwyg" class="form-control control-5-rows textarea" @error('text') is-invalid @enderror placeholder="Enter text ..." spellcheck="false" name="text" required>{{ $ad->text }}</textarea>
            @else <textarea id="wysiwyg" class="form-control control-5-rows textarea" @error('text') is-invalid @enderror placeholder="Unesite tekst ..." spellcheck="false" name="text" required >{{ old('text') }}</textarea>
            @endif
            @error('text')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class = "form-group">
        <div class="col-md-2">
            <label class="control-label">Link:</label>
        </div>
        <div class="col-md-10">
            @if(isset($ad)) <input type="url" name="link" id = "link" class="form-control" @error('link') is-invalid @enderror placeholder="link" value="{{ $ad->link }}" required/>
            @else <input type="url" name="link" id ="link" class="form-control form-validate" @error('link') is-invalid @enderror placeholder="link" value="{{ old('link') }}" required/>
            @endif
            @error('link')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class = "form-group"><!-- Select Type-->
        <div class="col-md-2">
            <label class="control-label">Tip Linka:</label>
        </div>
        <div class="col-md-10">
            @if(isset($ad)) <input type="text" name="link_type" id = "link_type" class="form-control" @error('link_type') is-invalid @enderror placeholder="Tip linka" value="{{ $ad->link_type }}" required/>
            @else <input type="text" name="link_type" id ="link_type" class="form-control form-validate" @error('link_type') is-invalid @enderror placeholder="Tip linka" value="{{ old('link_type') }}" required/>
            @endif
            @error('link_type')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

    </div><!-- end of type selection form field -->
    <div class = "form-group">
        <div class="col-md-2">
            <label class="control-label">Title Linka:</label>
        </div>
        <div class="col-md-10">
            @if(isset($ad)) <input type="text" name="link_title" id = "link_title" class="form-control" @error('link_title') is-invalid @enderror placeholder="Title linka" value="{{ $ad->link_title }}" required />
            @else <input type="text" name="link_title" id ="link_title" class="form-control form-validate" @error('link_title') is-invalid @enderror placeholder="Title linka" value="{{ old('link_title') }}" required />
            @endif
            @error('link_title')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class = "form-group">
        <div class="col-md-2">
            <label class="control-label">Tekst Linka:</label>
        </div>
        <div class="col-md-10">
            @if(isset($ad)) <input type="text" name="link_text" id = "link_text" class="form-control" @error('link_text') is-invalid @enderror placeholder="Tekst linka" value="{{ $ad->link_text }}" required>
            @else <input type="text" name="link_text" id ="link_text" class="form-control form-validate" @error('link_text') is-invalid @enderror placeholder="Tekst linka" value="{{ old('link_text') }}" required>
            @endif
            @error('link_text')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div><!-- end of form group -->
<div class="form-group">
    <div class="form-footer col-lg-offset-1 col-md-offset-1 col-sm-9">
        <button type="button" class="btn btn-primary" id="addBuilding" data-toggle="modal" data-target="#simpleModal">{{$submit}} Oglas</button>
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
                    @endif <text>ovaj Oglas?</text>
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
