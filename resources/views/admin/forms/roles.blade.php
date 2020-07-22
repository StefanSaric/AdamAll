<div class="form-group">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    @if(isset($role))
        <div class="form-group" display="none">
            <input class="hidden" name="user_id" id="user_id" value="{{ $role->id }}">
        </div>
    @endif
    <div class = "form-group"><!-- Add/edit Role's name-->
        <div class="col-md-2">
            <label class="control-label">{{__('Name')}}:</label>
        </div>
        <div class="col-md-10">
            @if(isset($role)) <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" " placeholder="" value="{{ $role->name }}" required></input>
            @else <input type="text" name="name" id="name" class="form-control form-validate @error('name') is-invalid @enderror"" placeholder="" value="{{ old('name') }}" required></input>
            @endif
            @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div><!-- end of "name" form field -->
    <div class="form-group">
        <div class="form-footer col-lg-offset-1 col-md-offset-1 col-sm-9">
            <button type="button" class="btn btn-primary" id="addBuilding" data-toggle="modal" data-target="#simpleModal">{{__($submit)}}</button>
        </div>
    </div>
<!-- START SIMPLE MODAL MARKUP -->
<div class="modal fade" id="simpleModal" tabindex="-1" role="dialog" aria-labelledby="simpleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="simpleModalLabel">{{__('Save changes')}}</h4>
            </div>
            <div class="modal-body">
                <p><text>{{__('Do you wish to keep changes?')}}</text>
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">{{__('No')}}</button>
                <button type="submit" id="submitBuilding" class="btn btn-primary">{{__('Save')}}</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- END SIMPLE MODAL MARKUP -->
