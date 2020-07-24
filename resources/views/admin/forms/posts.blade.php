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
            @if(isset($post)) <input type="text" name="title" id = "title" class="form-control" placeholder="naslov" value="{{ $post->title }}" required />
            @else <input type="text" name="title" id ="title" class="form-control form-validate" placeholder="naslov" required />
            @endif
        </div>
    </div>
    <div class = "form-group">
        <div class="col-md-2">
            <label class="control-label">Izvor Posta:</label>
        </div>
        <div class="col-md-10">
            @if(isset($post)) <input type="text" name="source" id = "source" class="form-control" placeholder="izvor" value="{{ $post->source }}" />
            @else <input type="text" name="source" id ="source" class="form-control form-validate" placeholder="izvor" />
            @endif
        </div>
    </div>
    <div class = "form-group">
        <div class="col-md-2">
            <label class="control-label">Link ka izvoru:</label>
        </div>
        <div class="col-md-10">
            @if(isset($post)) <input type="url" name="link" id = "link" class="form-control" placeholder="Link" value="{{ $post->link }}" />
            @else <input type="url" name="link" id ="link" class="form-control form-validate" placeholder="Link" />
            @endif
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
            @if(isset($post)) <textarea id="wysiwyg" class="form-control control-5-rows textarea" placeholder="Enter text ..." spellcheck="false" name="text" >{{ $post->text }}</textarea>
            @else <textarea id="wysiwyg" class="form-control control-5-rows textarea" placeholder="Unesite tekst ..." spellcheck="false" name="text"  ></textarea>
            @endif
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-2">
            <label class="control-label">Slike:</label>
        </div>
        <div class="col-md-10">
            <input type="file" name="photos[]" id="uploadPhotoFiles" class="uploadPhotoFiles" accept="image/jpg, image/jpeg, image/png" multiple />
            <input type="file" name="video" id="uploadVideoFiles" class="uploadVideoFiles" style="<?php if(!isset($post) || $post->type->id != 4) { echo "display:none;"; } ?> " accept="video/jpeg2000, video/mp4" multiple  />
        </div>
    </div>
    <div class = "form-group">
        <div class="col-md-2">
            <label class="control-label">Datum:</label>
        </div>
        <div class="col-md-10">
            @if(isset($posts))<input id='datepicker' type="date" name="date" id = "date" class="form-control datepicker" placeholder="" value="{{ $posts->date }}" data-provide="datepicker" required></input>
            @else <input id='datepicker' type="date" name="date" id ="date" class="form-control form-validate datepicker" placeholder="" data-provide="datepicker" value="{{date("Y-m-d")}}" required></input>
            @endif
        </div>
    </div>
    <div class = "form-group">
        <div class="col-md-2">
            <label class="control-label">Autor teksta:</label>
        </div>
        <div class="col-md-10">
            @if(isset($post)) <input type="text" name="signature" id = "signature" class="form-control" placeholder="Autor" value="{{ $post->signature }}" required></input>
            @else <input type="text" name="signature" id ="signature" class="form-control form-validate" placeholder="Autor" required></input>
            @endif
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
