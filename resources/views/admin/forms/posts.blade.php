<div class="form-group">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    @if(isset($post))
        <div class="form-group" display="none">
            <input class="hidden" name="news_id" id="faq_id" value="{{ $post->id }}">
        </div>
    @endif
    <div class = "form-group"><!-- Select Type-->
        <div class="col-md-2">
            <label class="control-label">Tip:</label>
        </div>
        <div class="col-md-10">
            <select name="category_id" id="category_id" class="form-control" placeholder="tip" required>
                <option value="1" <?php if(isset($post) && $post->category_id == 1){ echo 'selected="selected"';} ?> >Vest</option>
                <option value="2" <?php if(isset($post) && $post->category_id == 2){ echo 'selected="selected"';} ?> >Izjava</option>
            </select>
        </div>
    </div><!-- end of type selection form field -->
    <div class = "form-group">
        <div class="col-md-2">
            <label class="control-label">Naslov:</label>
        </div>
        <div class="col-md-10">
            @if(isset($post)) <input type="text" name="title" id = "title" class="form-control" @error('title') is-invalid @enderror placeholder="naslov" value="{{ $post->title }}" required />
            @else <input type="text" name="title" id ="title" class="form-control form-validate" @error('title') is-invalid @enderror placeholder="naslov" value="{{ old('title') }}" required />
            @endif
            @error('title')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class = "form-group">
        <div class="col-md-2">
            <label class="control-label">Izvor Posta:</label>
        </div>
        <div class="col-md-10">
            @if(isset($post)) <input type="text" name="source" id = "source" class="form-control" @error('source') is-invalid @enderror placeholder="izvor" value="{{ $post->source }}" />
            @else <input type="text" name="source" id ="source" class="form-control form-validate" @error('source') is-invalid @enderror placeholder="izvor" value="{{ old('source') }}" />
            @endif
            @error('source')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class = "form-group">
        <div class="col-md-2">
            <label class="control-label">Link ka izvoru:</label>
        </div>
        <div class="col-md-10">
            @if(isset($post)) <input type="url" name="link" id = "link" class="form-control" @error('link') is-invalid @enderror placeholder="Link" value="{{ $post->link }}" />
            @else <input type="url" name="link" id ="link" class="form-control form-validate" @error('link') is-invalid @enderror placeholder="Link" value="{{ old('link') }}"/>
            @endif
            @error('link')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class = "form-group"><!-- Select Type-->
        <div class="col-md-2">
            <label class="control-label">Tip Materijala:</label>
        </div>
        <div class="col-md-10">
            <select name="type_id" id="type_id" class="form-control" placeholder="tip" required>
                @foreach($types as $type)
                <option value="{{ $type->id }}" <?php if(isset($post) && $post->type_id == $type->id){ echo 'selected="selected"';} ?> >{{ $type->name }}</option>
                @endforeach
            </select>
        </div>
    </div><!-- end of type selection form field -->
    <div class="form-group">
        <div class="col-md-2">
            <label class="control-label">Tekst:</label>
        </div>
        <div class="col-md-10">
            @if(isset($post)) <textarea id="wysiwyg" class="form-control control-5-rows textarea" @error('text') is-invalid @enderror placeholder="Enter text ..." spellcheck="false" name="text" >{{ $post->text }}</textarea>
            @else <textarea id="wysiwyg" class="form-control control-5-rows textarea" @error('text') is-invalid @enderror placeholder="Unesite tekst ..." spellcheck="false" name="text" >{{ old('text') }}</textarea>
            @endif
            @error('text')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-2">
            <label class="control-label">Slike:</label>
        </div>
        <div class="col-md-10">
        @if(!isset($post))
            <input type="file" name="photos[]" id="uploadPhotoFiles" class="uploadPhotoFiles" accept="image/jpg, image/jpeg, image/png" multiple />
            <input type="file" name="video" id="uploadVideoFiles" class="uploadVideoFiles" style="<?php if(!isset($post) || $post->type->id != 4) { echo "display:none;"; } ?> " accept="video/jpeg2000, video/mp4" multiple  />
        @else
            @if($post->type->name <> 'Video')
                <input type="file" name="photos[]" id="uploadPhotoFiles" class="uploadPhotoFiles" accept="image/jpg, image/jpeg, image/png" multiple />
            @else
               <input type="file" name="video" id="uploadVideoFiles" class="uploadVideoFiles" accept="video/jpeg2000, video/mp4" multiple  />
            @endif
        @endif
        </div>
    </div>
    @if(isset($post))
        <div class="form-group">
            <div class="col-md-2"></div>
            <div class="col-md-10">
                <div id="gallery">
                    <div id="image-container">
                        <ul id="image-list">
                        @foreach($post->materials as $material)
                        <li style="list-style-type: none;" id="image_{{$material->id}}">
                            <div class="row">
                            <div class="col-md-2" id="imagediv_{{$material->id}}">
                                <div class="box-head">
                                    <header>
                                    </header>
                                    <div class="tools">
                                        <div class="btn-group btn-group-transparent">
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-equal btn-sm removeImageDiv" id="remove_{{$material->id}}"><i class="fa fa-times"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <img class="thumbnail img-responsive img" src="{{asset($material->url)}}"  style="background-color: #f7f7f7; width:100%">
                            </div>
                            <div class="col-md-10"></div>
                            </div>
                        </li>
                        @endforeach

                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <input type="hidden" id="removematerials" name="removematerials" value="[]">
        <input type="hidden" id="sortImages" name="sortImages" value="[]">
        @endif
    <div class = "form-group">
        <div class="col-md-2">
            <label class="control-label">Datum:</label>
        </div>
        <div class="col-md-10">
            @if(isset($posts))<input id='datepicker' type="date" name="date" id = "date" class="form-control datepicker" placeholder="" value="{{ $posts->date }}" data-provide="datepicker" required>
            @else <input id='datepicker' type="date" name="date" id ="date" class="form-control form-validate datepicker" placeholder="" data-provide="datepicker" value="{{date("Y-m-d")}}" required>
            @endif
        </div>
    </div>
    <div class = "form-group">
        <div class="col-md-2">
            <label class="control-label">Autor teksta:</label>
        </div>
        <div class="col-md-10">
            @if(isset($post)) <input type="text" name="signature" id = "signature" class="form-control" @error('signature') is-invalid @enderror placeholder="Autor" value="{{ $post->signature }}" required>
            @else <input type="text" name="signature" id ="signature" class="form-control form-validate" @error('signature') is-invalid @enderror placeholder="Autor" value="{{ old('signature') }}" required>
            @endif
            @error('signature')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div><!-- end of form group -->
<div class="form-group">
    <div class="form-footer col-lg-offset-1 col-md-offset-1 col-sm-9">
        <button type="button" class="btn btn-primary" id="addBuilding" data-toggle="modal" data-target="#simpleModal">{{$submit}} Post</button>
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
                    @endif <text>ovaj Post?</text>
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
