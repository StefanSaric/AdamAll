<div class="form-group">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    @if(isset($news))
        <div class="form-group" display="none">
            <input class="hidden" name="id" id="id" value="{{ $news->id }}">
        </div>
    @endif
    <div class = "form-group">
        <div class="col-md-2">
            <label class="control-label">Naslov:</label>
        </div>
        <div class="col-md-10">
            @if(isset($news)) <input type="text" name="title" id = "title" class="form-control" @error('title') is-invalid @enderror placeholder="Naslov" value="{{ $news->title }}" required />
            @else <input type="text" name="title" id ="title" class="form-control form-validate" @error('title') is-invalid @enderror placeholder="Naslov" value="{{ old('title') }}" required />
            @endif
            @error('title')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-2">
            <label class="control-label">Slika:</label>
        </div>
        <div class="col-md-10">
            <input type="file" name="photos" id="uploadPhotoFiles" class="uploadPhotoFiles" accept="image/jpg, image/jpeg, image/png" multiple />
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-2">
            <label class="control-label">Tekst:</label>
        </div>
        <div class="col-md-10">
            @if(isset($news)) <textarea id="wysiwyg" class="form-control control-5-rows textarea" @error('text') is-invalid @enderror placeholder="Enter text ..." spellcheck="false" name="text" required>{{ $news->text }} </textarea>
            @else <textarea id="wysiwyg" class="form-control control-5-rows textarea" @error('text') is-invalid @enderror placeholder="Unesite tekst ..." spellcheck="false" name="text"  required>{{ old('text') }}</textarea>
            @endif
            @error('text')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class = "form-group"><!-- Select Type-->
        <div class="col-md-2">
            <label class="control-label">Link ka Postu:</label>
        </div>
        <div class="col-md-10">
            <select name="post_link" id="post_link" class="form-control" placeholder="post_link" required>
                @foreach($posts as $num=>$post)
                    @if ($post->category_id == 1)
                        <option value="{{"Vest_".$post->id}}">{{$post->title}}</option>
                    @endif
                @endforeach
            </select>
        </div>

    </div><!-- end of type selection form field -->
<div class="form-group">
    <div class="form-footer col-lg-offset-1 col-md-offset-1 col-sm-9">
        <button type="button" class="btn btn-primary" id="addBuilding" data-toggle="modal" data-target="#simpleModal">{{$submit}} Vest</button>
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
                    @endif <text>ovu Vest?</text>
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
