<div class="form-group">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    @if(isset($user))
        <div class="form-group" display="none">
            <input class="hidden" name="user_id" id="user_id" value="{{ $user->id }}">
        </div>
    @endif
    <div class = "form-group"><!-- Add/edit User's name-->
        <div class="col-md-2">
            <label class="control-label">{{__('Name')}}:</label>
        </div>
        <div class="col-md-10">
            @if(isset($user)) <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"" placeholder="name" value="{{ $user->name }}" required></input>
            @else <input type="text" name="name" id="name" class="form-control form-validate @error('name') is-invalid @enderror"" placeholder="name" value="{{ old('name') }}" required></input>
            @endif
            @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div><!-- end of "name" form field -->
    <div class = "form-group"><!-- Add/edit User's e-mail-->
        <div class="col-md-2">
            <label class="control-label">{{__('E-mail')}}:</label>
        </div>
        <div class="col-md-10">
            @if(isset($user)) <input type="text" name="email" id = "email" class="form-control @error('email') is-invalid @enderror" placeholder="e-mail" value="{{ $user->email }}" required></input>
            @else <input type="text" name="email" id ="email" class="form-control form-validate @error('email') is-invalid @enderror" placeholder="e-mail" value="{{ old('email') }}" required></input>
            @endif
            @error('email')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div><!-- end of "country" form field -->
    <div class = "form-group"><!-- Add/edit ASN country-->
        <div class="col-md-2">
            <label class="control-label">{{__('Password')}}:</label>
        </div>
        <div class="col-md-10">
            <input type="text" name="password" id ="password" class="form-control form-validate" placeholder=""  value="{{ old('password') }}" <?php if(!isset($user)){echo 'required="required"';}?>></input>
        </div>
    </div><!-- end of "country" form field -->
    <div class="form-group">
        <div class="col-md-2">
            <label class="control-label">{{__('Roles')}}</label>
        </div>
        <div class="col-md-10">
            <div class="section-body">
                <div class="row">
                    <div class="box box-outlined">
                        <div id="roles" class="box-body table-responsive">
                            <table id="datatable" class="table table-striped table-hover">
                                <thead>
                                <tr>
                                    <th>&nbsp;&nbsp;&nbsp;#</th>
                                    <th>{{__('Roles')}}</th>
                                    <th style="min-width: 85px">{{__('Actiones')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($roles as $num => $role)
                                    <tr id="client_{{ $role->id }}" class="gradeX">
                                        <td>&nbsp;&nbsp;&nbsp;{{ $num + 1 }}</td>
                                        <td>{{ __($role->name) }}</td>
                                        <td>
                                            <input type="checkbox" <?php if(isset($user)){ foreach($userroles as $key => $userRole){ if($userRole->id == $role->id) echo 'checked'; else echo '';} } ?>  class="deleteRole role{{ $role->id }}" value="{{ $role->id }}" name="role_id[]" id="role{{$role->id}}">
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div><!--end .box-body -->
                    </div><!--end .box -->
                </div>
                <!-- END STRIPED TABLE -->
            </div>
        </div>
    </div>
</div><!-- end of form group -->
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
